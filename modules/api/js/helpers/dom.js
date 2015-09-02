var dom = {},
    div = document.createElement('div');

/**
 * Attach an event listener to a reference
 * 
 * @param {Node} reference
 * @param {String} event
 * @param {Function} callback
 */
dom.on = function (reference, event, callback) {
    reference = reference || document;
    
    reference.addEventListener(event, callback);
};

/**
 * Find an element
 * 
 * @param {String} selector
 * @param {Node} reference
 * @return {Node|null}
 */
dom.find = function (selector, reference) {
    return (reference || document).querySelector(selector);
};

/**
 * Find all elements 
 * 
 * @param {String} selector
 * @param {Node} reference
 * @return {NodeList|null}
 */
dom.findAll = function (selector, reference) {
    return (reference || document).querySelectorAll(selector);
};

/**
 * Create new node from HTML or tag name
 * 
 * @param {String} html
 * @return {Node}
 */
dom.node = function (html) {
    html = html.trim();
    
    if (html[0] !== '<' && html[html.length - 1] !== '>') {
        return document.createElement(html);
    }
    
    div.innerHTML = html;
    
    return div.children[0];
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