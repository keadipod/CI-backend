var UINestable = function () {
    var t = function (t) {
        var e = t.length ? t : $(t.target),
            a = e.data("output");
        window.JSON ? a.val(window.JSON.stringify(e.nestable("serialize"))) : a.val("JSON browser support required for this demo.")
    };
    return {
        init: function () {
            $("#nestable_list_1").nestable({
                group: 1,
                maxDepth : 10,
            })
        }
    }
}();
jQuery(document).ready(function () {
    UINestable.init()
});