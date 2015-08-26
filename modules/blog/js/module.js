(function () {
    var View = mini_blog.component.view;
    
    /** Mapper */
    var mapper = new mini_blog.mvc.mapper({
        baseurl: 'api/posts'
    });
    
    mapper.parse = function (data) {
        return data.item;
    };
    
    /** Posts collection */
    var posts = new mini_blog.mvc.collection;
    
    posts.bindTo(mapper);
    
    /**
     * Post view
     */
    var PostView = mini_blog.component.view.extend({
        /**
         * Render the view
         */
        render: function () {
            this.subrender();
            this.highlight();
        },
        
        /**
         * Subrender
         */
        subrender: function () {
            View.prototype.render.call(this);
        },
        
        /**
         * Highlight the code
         */
        highlight: function () {
            mini_blog.toArray(this.node.querySelectorAll('pre'))
                     .forEach(hljs.highlightBlock);
        }
    });
    
    /**
     * Post component constructor
     * 
     * @param {Object} attributes
     * @param {Node} node
     */
    var Post = function (node) {
        mini_blog.component.call(this, node);
    };

    Post.prototype = Object.create(mini_blog.component.prototype);
    
    /**
     * Initialize the component
     */
    Post.prototype.initialize = function () {
        this.id   = this.node.dataset.id;
        this.post = posts.get(this.id) || mapper.create();
        
        if (this.post.isEmpty() && this.id) {
            mapper.fetch(this.id, this.post);
        }
        
        this.createView();
        this.view.highlight();
    };
    
    Post.prototype.enable = function () {
        mini_blog.component.prototype.enable.call(this);
        
        this.view.subrender();
    };
    
    /**
     * Create view
     */
    Post.prototype.createView = function () {
        this.view = new PostView(this.node, {
            model: this.post
        });
    };
    
    /**
     * Cancel editing
     */
    Post.prototype.cancel = function () {
        if (!this.post.isNew()) {
            return this.post.revert();
        }
        
        this.node.parentNode.removeChild(this.node);
    };
    
    /**
     * Remove a post
     */
    Post.prototype.remove = function () {
        if (this.post.isNew()) {
            return;
        }
        
        var self = this;
        
        mapper.remove(this.post, function () {
            self.cancel();
        });
    };
    
    /**
     * Save a post
     */
    Post.prototype.save = function () {
        this.post.merge(this.view.collectData());
        
        mapper.save(this.post);
        
        this.post.clear();
    };
    
    mini_blog.components.register('post', Post);
    
    mini_blog.posts = {
        collection: posts
    };
})();