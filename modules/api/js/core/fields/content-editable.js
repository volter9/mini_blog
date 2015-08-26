module.exports = {
    create: function (node) {
        return node;
    },
    
    activate: function (node) {
        node.setAttribute('contenteditable', 'true');
        node.classList.add('m-editable');
    },
    
    deactivate: function (node) {
        node.removeAttribute('contenteditable');
        node.classList.remove('m-editable');
    }
};