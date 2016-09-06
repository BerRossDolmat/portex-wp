jQuery.fn.outerHTML = function() {
  return jQuery('<div />').append(this.eq(0).clone()).html();
};

$( document ).ready(function(){

  // Get all tables

  initialTables = $( "#product-content > table" );

  // Make THeads and add tabl class

  $( initialTables ).each(function(i){
    $( this ).addClass('bordered');
    if ($(this).children('thead').length === 0) {
      $( this ).prepend('<thead></thead>')
      $( this ).find('thead').append($(this).find("tr:eq(0)"));
      $(this).find('thead').find('tr').children('td').replaceWith(function(i, html) {
        return '<th>' + html + '</th>';
      });
    }
  });

  // Remove junk classes
  var whitelist = ['align'];

  $(initialTables).find("*").each(function(){
    var attributes = this.attributes;
    var i = attributes.length;
    while ( i-- ) {
      var attr = attributes[i];
      if ( $.inArray(attr.name,whitelist) == -1 )
        this.removeAttributeNode(attr);
    }
  });

  // Style headers

  // $(initialTables).find("tr").each(function(){
  //   if ($(this).children('td').length === 1) {
  //     $(this).children('td').attr('colspan', 2);
  //     $(this).attr('style', 'font-weight: 500');
  //   }
  // });

  // var modaltr = $('#product-content > table > thead tr');
  // $("<tr><th></th>" + $(modaltr).html() + "</tr>").appendTo( $("#modalTable thead") );

  $(initialTables).find("*").each(function(){
    if($(this).attr('align')){
      if ($(this).attr('style')) {
        $(this).attr('style','text-align:' + $(this).attr('align')+';'+$(this).attr('style'));
      } else {
        $(this).attr('style','text-align:' + $(this).attr('align')+';');
      }
      $(this).removeAttr('align')
    }
  });

  // Clone table to modal
  $(initialTables).each(function(i){
    $( this ).clone().appendTo( "#modalPlaceForTables" );
  })

  var modalTables = $( "#modalPlaceForTables > table" );

  $(modalTables).each(function(index){
    $(this).children("thead").children("tr").prepend("<th>Количество</th>");
    $(this).children("tbody").children("tr").prepend("<td>" + getControls() + "</td>");
  });

  // Show ready content

  $( '#product-content' ).fadeIn(500);

  // Quantity control functions

  $( '.increaseValue' ).on( 'click', function(event) {
    event.preventDefault();
    var oldValue = +($( this ).siblings( "input" ).val());
    var newValue = oldValue + 1;
    $( this ).siblings( "input" ).attr('value', newValue);
  });

  $( '.decreaseValue' ).on( 'click', function(event) {
    event.preventDefault();
    if ( $( this ).siblings( "input" ).val() === '' || $( this ).siblings( "input" ).val() <= 0 ) {
      return false;
    } else {
      var oldValue = +($( this ).siblings( "input" ).val());
      var newValue = oldValue - 1;
      $( this ).siblings( "input" ).attr('value', newValue);
    }
  });

  // $( '#submitOrder').on("click", function(event) {
  //   event.preventDefault();
  //   var orderSuccess = "Все ок";
  //   var orderFail = "Ошибка";
  //   Materialize.toast(orderSuccess, 20000, 'toast-style grey lighten-5');
  //   $('#modal-add-order').closeModal();
  // });
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
  $( ".toast-style" ).hide();
}

// function newOrder(event) {
//   event.preventDefault();
//   var allModalProducts = $( "#modalPlaceForTables > table > tbody > tr" );
//   var chosenProducts = [];
//   $( allModalProducts ).each(function() {
//     if ($( this ).children( 'td' ).children( 'input' ).val() > 0) {
//       var newTdValue = $(this).children('td').children('input').val();
//       var newTd = '<td>' + newTdValue + '</td>';
//       var newThis = $(this).clone();
//       $(newThis).children('td').first().replaceWith(newTd);
//       $(newThis).children('td').attr('style', 'border: 1px solid black; text-align: center');
//       chosenProducts.push(newThis.outerHTML());
//     }
//   });

function newOrder(event) {
  event.preventDefault();
  var allModalTables = $( "#modalPlaceForTables > table" );
  var newAllModalTables = $(allModalTables).clone();
  $(newAllModalTables).children('tbody').children('tr').each(function() {
    if ($(this).find('input').val() == 0) {
      $(this).remove();
    }
  });
  // if (chosenProducts.length === 0) {
  //   return false;
  // }
  var tables = $(newAllModalTables).outerHTML();
  var order = new Object;

  order.type = "new-order";

  order.name = $( '#name-order' ).val();
  $( '#name-order' ).val('');

  order.email = $( '#email-order' ).val();
  $( '#email-order' ).val('');

  order.message = $( '#message-order' ).val();
  $( '#message-order' ).val('');

  order.tel = $( '#tel-order' ).val();
  $( '#tel-order' ).val('');

  order.title = $('.product_title').html();
  order.body = JSON.stringify(tables);

  $.ajax({
    url: '/wp-json/mail/send',
    type: 'POST',
    data: order,
    success: function(){
      $('#modal-add-order').closeModal();
      Materialize.toast(newOrderMessageSuccess, 20000, 'toast-style grey lighten-5');
    },
    error: function(){
      $('#modal-add-order').closeModal();
      Materialize.toast(newOrderMessageError, 20000, 'toast-style grey lighten-5');
    }
  });

};
