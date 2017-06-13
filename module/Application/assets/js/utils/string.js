String.prototype.ucfirst = function () {
    return this.charAt(0).toUpperCase() + this.slice(1);
};
String.prototype.lcfirst = function () {
    return this.charAt(0).toLowerCase() + this.slice(1);
};
String.prototype.camelToUS = function (s) {
    s = s || '_';
    return this.replace(/[A-Z]/g, s + '$&').toLowerCase();
};
