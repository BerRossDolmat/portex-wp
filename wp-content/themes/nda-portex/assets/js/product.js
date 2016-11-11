jQuery.fn.outerHTML = function() {
    return jQuery('<div />').append(this.eq(0).clone()).html();
}

$(document).ready(function() {

    // Get all tables

    initialTables = $("#product-content > table");

    // Make THeads and add table class

    $(initialTables).each(function(i) {
        $(this).addClass('bordered');
    });

    if ($('#minified').val() == 'true') {
        initialTables.find('td').each(function(i) {
            $(this).addClass('minified');
        });
    }

    // Create table headers

    $(initialTables).each(function(i) {
        if ($(this).children('thead').length === 0) {
            $(this).prepend('<thead></thead>')
            $(this).find('thead').append($(this).find("tr:eq(0)"));
            $(this).find('thead').find('tr').children('td').replaceWith(function(i, html) {
                return '<th>' + html + '</th>';
            });
        }
    });

    // // Remove junk classes
    var whitelist = ['align', 'colspan', 'class'];

    // $(initialTables).find("*").each(function() {
    //     var attributes = this.attributes;
    //     var i = attributes.length;
    //     while (i--) {
    //         var attr = attributes[i];
    //         if ($.inArray(attr.name, whitelist) == -1)
    //             this.removeAttributeNode(attr);
    //     }
    // });

    $(initialTables).find('td').each(function() {
        $(this).css('text-align', 'center');
    });

    $(initialTables).find('th').each(function() {
        $(this).css('text-align', 'center');
    });

    $(initialTables).each(function() {
        $(this).css('width', '100%');
    });


    // Check slider options

    if ($('#slider_left').val() == 'true') {
        $('#slider-holder').attr('class', 'col s12 m5 offset-m1');
        $('#slideshow').attr('class', 'card-image col s12');
        $('#slideshow-thumbs-holder').attr('class', 'col s12');
        $('.card-content').attr('class', 'card-content col s12 m5');
        $('#product-description').remove();

        $('.card-content').after('<div class="col s10 offset-s1" id="slider-left-for-tables"></div>');
        $('#slider-left-for-tables').append($(initialTables));
        $('#slider-left-for-tables').append($('#cert-and-order'));
        $('#slider-holder').fadeIn(500);
    } else {
        $('#slider-holder').fadeIn(500);
    }

    // Clone table to modal
    $(initialTables).each(function(i) {
        $(this).clone().appendTo("#modalPlaceForTables");
    })

    var modalTables = $("#modalPlaceForTables > table");

    $(modalTables).each(function(index) {
        $(this).children("thead").children("tr").prepend("<td>Количество</td>");
        $(this).children("tbody").children("tr").each(function() {
            if ($(this).children('td').attr('colspan') > 0) {
                $(this).children('td').attr('colspan', +$(this).children('td').attr('colspan') + 1);
            }
            empty_cells = $(this).children('td').html() == '<span style="color: #000000;">&nbsp;</span>';
            if (empty_cells) {
                $(this).prepend("<td></td>");
            } else {
                $(this).prepend("<td style='width: 80px;' class='minified btns-paddingtop'>" + getControls() + "</td>");
            }
        });
    });

    // $(modalTables).each(function(index) {
    //     $(this).children("thead").children("tr").prepend("<td>Количество</td>");
    //     $(this).children("tbody").children("tr").each(function() {
    //         if ($(this).children('td').attr('colspanned') == 1) {
    //             var newColspan = $(this).children('td').first().attr('colspan');
    //             $(this).children('td').first().attr('colspan', +newColspan + +1);
    //         } else if ($(this).children('td').first().html() == '<span>&nbsp;</span>' && $(this).children('td').last().html() == '<span>&nbsp;</span>') {
    //             $(this).prepend("<td><span>&nbsp;</span></td>");
    //         } else {
    //             $(this).prepend("<td>" + getControls() + "</td>");
    //         }
    //     });
    // });

    // Show ready content

    $('#product-content').fadeIn(500);

    // Quantity control functions

    $('.increaseValue').on('click', function(event) {
        event.preventDefault();
        var oldValue = +($(this).siblings("input").val());
        var newValue = oldValue + 1;
        $(this).siblings("input").attr('value', newValue);
    });

    $('.decreaseValue').on('click', function(event) {
        event.preventDefault();
        if ($(this).siblings("input").val() === '' || $(this).siblings("input").val() <= 0) {
            return false;
        } else {
            var oldValue = +($(this).siblings("input").val());
            var newValue = oldValue - 1;
            $(this).siblings("input").attr('value', newValue);
        }
    });

    $('#submitOrder').on("click", function(event) {
        event.preventDefault();
        var orderSuccess = "Все ок";
        var orderFail = "Ошибка";
        Materialize.toast(orderSuccess, 20000, 'toast-style grey lighten-5');
        $('#modal-add-order').closeModal();
    });
});

function getControls() {
    return `
    <button
      class="order-number-btn-minus waves-effect waves-blue white blue-grey-text text-darken-4 tooltipped decreaseValue"
      data-position="top"
      data-delay="150"
      data-tooltip="Уменьшить количество товара"
    >
      -
    </button>
    <input type="text" class="order-input" placeholder="0">
    <button
      class="order-number-btn-plus waves-effect waves-blue blue tooltipped increaseValue"
      data-position="top"
      data-delay="150"
      data-tooltip="Увеличить количество товара"
    >
      +
    </button>
    `;
};

var newOrderMessageSuccess = $('<div><h5>Уважаемые коллеги!</h5> <p>Ваша заявка получена, и принята в работу. В ближайшее время (не позднее 24 часов Вы получите ответ или готовое коммерческое предложение. В случае если оно Вас устроит, Вам будет выставлен официальный счет для оплаты.</p><p> С уважением коллектив ООО НДА Деловая медицинская компания</p><div><a href="#!" onclick="closeToast()" class=" modal-action modal-close waves-effect waves-blue btn-flat">Закрыть</a></div></div>');
var newOrderMessageError = $('<div><h5>Произошла ошибка!</h5> <p>Попробуйте еще раз.</p><div><a href="#!" onclick="closeToast()" class=" modal-action modal-close waves-effect waves-blue btn-flat">Закрыть</a></div></div>');

function closeToast() {
    $(".toast-style").hide();
}

function newOrder(event) {
    event.preventDefault();

    if ($('#req-file').get(0).files.length > 0) {
        var file = $('#req-file').get(0).files[0];
        if (file.size / 1024 / 1024 > 10) {
            $('#error-filesize').show(500);
            return false;
        } else {
            $('#error-filesize').hide(500);
        }
        var filename = file.name;
        var parts = filename.split('.');
        var ext = parts[parts.length - 1];
        if (ext.toLowerCase() != 'xlsx') {
            $('#error-filetype').show(500);
            return false;
        } else {
            $('#error-filetype').hide(500);
        }
    }

    var allModalTables = $("#modalPlaceForTables > table");
    var newAllModalTables = $(allModalTables).clone();
    $(newAllModalTables).children('tbody').children('tr').each(function() {
        if ($(this).find('input').val() == 0) {
            $(this).remove();
        }
        var newTd = $(this).find('input').val();
        $(this).find('button').remove();
        $(this).find('input').replaceWith(newTd);
    });
    var tables = [];
    $(newAllModalTables).each(function() {
        tables.push($(this).outerHTML());
    });

    var order = new FormData();
    var formData = new FormData();
    formData.append('type', "new-order");
    formData.append('name', $('#name-order').val());
    formData.append('email', $('#email-order').val());
    formData.append('message', $('#message-order').val());
    formData.append('tel', $('#tel-order').val());
    if ($('#req-file').get(0).files.length > 0) {
        formData.append('file', $('#req-file')[0].files[0]);
    }
    formData.append('body', JSON.stringify(tables));
    formData.append('title', $('.product_title').html());

    $.ajax({
        url: '/wp-json/mail/send',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function() {
            $('#modal-add-order').closeModal();
            Materialize.toast(newOrderMessageSuccess, 20000, 'toast-style grey lighten-5');
        },
        error: function() {
            $('#modal-add-order').closeModal();
            Materialize.toast(newOrderMessageError, 20000, 'toast-style grey lighten-5');
        }
    });

};