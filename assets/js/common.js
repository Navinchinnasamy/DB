//== Class definition
var Common = function () {

    var bar = function () {
        bar1 = $('#bar-basic').progressbarManager({
            totalValue  : 100,
            animate     : true,
            currentValue: 0,
            stripe      : true
        });
        $("body").click(function () {
            var cur = bar1.getBar().currentValue;
            bar1.setValue(cur + 5);
        });
    }


    return {
        init: function () {
            bar();
        }
    };
}();

//== Class initialization on page load
jQuery(document).ready(function () {
    Common.init();
});