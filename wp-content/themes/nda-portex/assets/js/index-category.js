var $ = jQuery;

$(document).ready(function() {
    var windowWidth = window.innerWidth;
    if (windowWidth > 1280) {
        windowWidth = 1280;
    }
    var cardsLength = $('.minicard').length;
    var cardsWidth = $('.minicard').first().outerWidth();

    var cardsInRow = Math.floor(windowWidth / cardsWidth);

    var elementsToAddCount = cardsLength % cardsInRow;
    if (elementsToAddCount != 0) {
        $('.minicard').slice(-elementsToAddCount).addClass(`class${elementsToAddCount}of${cardsInRow}`);
    }

});