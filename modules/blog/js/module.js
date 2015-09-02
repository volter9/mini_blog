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
    
    var Url = mini_blog.field.extend({
        create: function () {
            return mini_blog.dom.node('<label class="m-field m-url-field">' 
                + 'Заметка будет размещена по этому адресу: '
                + '<span class="url">' + mini_blog.ajax.url('')
                + '<input class="m-input-field m-field url-field" placeholder="'
                + this.name
                + '">'
                + '</span></label>');
        },
        
        /**
         * @param {String} value
         */
        set: function (value) {
            this.field.querySelector('.url-field').value = value;
            this.node.href = mini_blog.ajax.url(value);
        },
        
        /**
         * @return {String}
         */
        value: function () {
            return this.field.querySelector('.url-field').value;
        }
    });
    
    var PostView = View.extend({
        /**
         * Post fields
         */
        fields: {
            title: {
                type: 'input',
                target: '[data-name=title]'
            },
            text: {
                type: 'text',
                target: '[data-name=text]',
                set: function (text) {
                    this.field.value = text;
                    this.node.innerHTML = markdown(text);
                }
            },
            url: {
                type: 'url',
                target: '[data-name=title]'
            }
        }
    });
    
    var Post = mini_blog.component.extend({
        /**
         * Initialize the component
         */
        initialize: function () {
            this.id   = this.node.dataset.id;
            this.post = posts.get(this.id) || mapper.create();
        
            if (this.post.isEmpty() && this.id) {
                mapper.fetch(this.id, this.post);
            }
        
            this.createView();
        },
        
        /**
         * Create view
         */
        createView: function () {
            this.view = new PostView(this.node, {
                model: this.post
            });
        },
        
        /**
         * Cancel editing
         */
        cancel: function () {
            if (!this.post.isNew()) {
                return this.post.revert();
            }
            
            this.node.parentNode.removeChild(this.node);
        },
        
        /**
         * Remove a post
         */
        remove: function () {
            if (this.post.isNew()) {
                return;
            }
            
            var self = this;
            
            mapper.remove(this.post, function () {
                self.cancel();
            });
        },
        
        /**
         * Save a post
         */
        save: function () {
            var data = this.view.collectData();
            
            if (Object.keys(data).length === 0) {
                return;
            }
            
            this.post.merge(data);
            
            mapper.save(this.post);
            
            this.post.clear();
        }
    });
    
    /* Registering URL field and Post component */
    mini_blog.fields.url = Url;
    mini_blog.components.register('post', Post);
    
    mini_blog.posts = {
        collection: posts
    };
})();