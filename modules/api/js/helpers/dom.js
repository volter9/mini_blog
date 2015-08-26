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

/**
 * Check whether node has a parent in the node chain
 * 
 * @param {Node} node
 * @param {Function} callback
 */
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
 * Insert node after the target node
 * 
 * @param {Node} target
 * @param {Node} node
 */
dom.insertAfter = function (target, node) {
    target.parentNode.insertBefore(node, target.nextSibling);
};

module.exports = dom;