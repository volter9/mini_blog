/**
 * Get unique integer generator
 * 
 * @param {Number} i - counter
 * @return {Function}
 */
module.exports = function (i) {
    i = i || (i = 0);

    /**
     * Unique integer return
     * 
     * @return {Number}
     */
    return function () {
        return ++i;
    };
};