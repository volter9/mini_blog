var dom = {};

/**
 * Get all attributes from DOM element
 * 
 * @link http://stackoverflow.com/questions/2048720/
 *       get-all-attributes-from-a-html-element-with-javascript-jquery
 * @param {Node} element
 * @return {Object}
 */
dom.attributes = function (element) {
    var result = {},
        attributes = element.attributes;
    
    for (var i = 0, l = attributes.length; i < l; i ++) {
        var attribute = attributes[i];
        
        result[attribute.nodeName] = attribute.nodeValue;
    }
    
    return result;
};

/**
 * Get all data attributes from DOM element
 * 
 * @param {Node} element
 * @return {Object}
 */
dom.dataAttributes = function (element) {
    var attributes = mini_blog.dom.attributes(element);
    
    Object.keys(attributes).forEach(function (key) {
        if (key.indexOf('data-') !== 0) {
            delete attributes[key];
        }
    });
    
    return attributes;
};

dom.hasParent = function (node, callback) {
    if (callback(node.parentNode)) {
        return true;
    }
    
    if (node.parentNode === document.documentElement) {
        return false;
    }
    
    return dom.hasParent(node.parentNode, callback)
};

/**
 * Make argument node HTML5 editable
 * 
 * @param {Node} node
 */
dom.makeEditable = function (node) {
    node.setAttribute('contenteditable', 'true');
    node.classList.add('m-editable');
    
    if (node.isEditable) {
        return;
    }
    
    node.addEventListener('paste', function(e) {
        e.preventDefault();

        var text = e.clipboardData
                    .getData('text/plain')
                    .replace(/\</g, '&lt;')
                    .replace(/\>/g, '&gt;')
                    .replace(/\n\r?/g, '<br/>\n');

        document.execCommand('insertHTML', false, text);
    });

    node.addEventListener('keyup', function (e) {
        if (e.keyCode === 13 && (!e.shiftKey || !e.ctrlKey)) {
            var selection = document.getSelection();
            
            var inList = dom.hasParent(selection.anchorNode, function (node) {
                var name = node.nodeName.toLowerCase();
                
                console.log(name);
                
                return name === 'li'
                    || name === 'pre';
            });
            
            if (!inList) {
                document.execCommand('formatBlock', null, 'p');
            }
        }
    });
    
    // Custom attribute
    node.isEditable = true;
};

/**
 * Unmake argument node HTML5 editable
 * 
 * @param {Node} node
 */
dom.unmakeEditable = function (node) {
    node.removeAttribute('contenteditable');
    node.classList.remove('m-editable');
};

module.exports = dom;