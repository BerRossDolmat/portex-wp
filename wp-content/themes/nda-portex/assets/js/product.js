jQuery.fn.outerHTML = function() {
  return jQuery('<div />').append(this.eq(0).clone()).html();
};

$( document ).ready(function(){

  // Get all tables

  tables = $( "table" );

  // Remove junk classes

  $( tables ).find('*').removeAttr('class');
  $( tables ).find('*').removeAttr('height');
  $( tables ).find('*').removeAttr('style');
  $( tables ).find('*').removeAttr('align');
  $( tables ).find('*').removeAttr('valign');
  $( tables ).find('colgroup').remove();

  $( tables ).each(function(i){
    $( this ).addClass('bordered');
    $( this ).prepend('<thead></thead>')
    $( this ).find('thead').append($(this).find("tr:eq(0)"));
    $(this).find('thead').find('tr').children('td').replaceWith(function(i, html) {
    return '<th>' + html + '</th>';
  });
  });



  // Check th



  // Show ready content

  $( '#product-content' ).fadeIn(500);

});
