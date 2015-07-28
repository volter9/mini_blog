(function () {
    /** Mapper */
    var mapper = new mini_blog.mvc.mapper({
        baseurl: 'admin/posts'
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
    var PostView = mini_blog.mvc.view.extend({
        /**
         * Initialize view
         */
        initialize: function () {
            this.data.post.on('change', this.render.bind(this));
        },
    
        /**
         * Render the view
         */
        render: function () {
            this.subrender();
            this.highlight();
        },
        
        subrender: function () {
            var data = this.data.post.all();
            
            console.log(data);
            
            mini_blog.each(this.data.nodes, function (node, key) {
                data[key] && (node.innerHTML = data[key]);
            });
        },
        
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
        this.mods = ['wysiwig'];
        
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
            post:  this.post,
            nodes: this.nodes
        });
    };

    /**
     * Cancel editing
     */
    Post.prototype.cancel = function () {
        if (this.id) {
            return this.post.revert();
        }
        
        this.node.parentNode.removeChild(this.node);
    };

    /**
     * Remove a post
     */
    Post.prototype.remove = function () {
        if (!this.id) {
            return;
        }
    
        mapper.remove(this.post);
        
        this.id = null;
        this.cancel();
    };

    /**
     * Save a post
     */
    Post.prototype.save = function () {
        this.post.merge(this.collectData());
        
        mapper.save(this.post);
        
        this.post.clear();
    };

    mini_blog.components.register('post', Post);
    
    mini_blog.posts = {
        collection: posts
    };
})();