$(document).ready(function () {
    // Stuff to do as soon as the DOM is ready
    var ticker = $("#ticker");
    var t;

    var li_count = 1;
    var li_length = $(".news-list .show-news").length;

    var li = $(".show-news").first();

    var runTicker = function (trans_width) {

        $(li).css({
            "right": +trans_width + "px"
        });
        t = setInterval(function () {
            if (parseInt($(li).css("right")) > -$(li).width()) {
                $(li).css({
                    "right": parseInt($(li).css("right")) - 1 + "px",
                    "display": "block"
                });
            } else {
                clearInterval(t);
                trans_width = ticker.width();
                li = $(li).next();
                if (li_count == li_length) {
                    li_count = 1;
                    li = $(".show-news").first();
                    runTicker(trans_width);
                } else if (li_count < li_length) {
                    li_count++;
                    setTimeout(function () {
                        runTicker(trans_width);
                    }, 500);
                }
            }
        }, 20);
    }
    $(ticker).hover(function () {
            clearInterval(t);
        },
        function () {
            runTicker(parseInt($(li).css("right")));
        });
    runTicker(ticker.width());

});