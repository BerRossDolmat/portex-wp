$( document ).ready(function(){

  // Sidenavigation

  $(".button-collapse").sideNav();

  // Trigger Modals

  $('.modal-trigger').leanModal();

  // Slider configuration

  $(".slider-no-display").removeClass( "slider-no-display" );

  $('.my-slider').unslider({
    keys: false,
    arrows: false,
    nav: false,
    autoplay: true,
    infinite: true
  });

  // Product Slider

  $('#slideshow').desoSlide({
    thumbs: $('#slideshow-thumbs li > a'),
    overlay: "none",
    thumbEvent: 'mouseover',
  });
});

// Scroll Reveal

var ScrollReveal
window.sr = ScrollReveal();
sr.reveal('.animate-fadein', {
  origin   : 'bottom',
  distance : '100px',
  duration : 1000,
  delay    : 200,
  viewOffset  : { top: 64 },
  scale: 0
});

sr.reveal('.contact-us-btn', {
  origin   : 'bottom',
  distance : '300px',
  duration : 1000,
  delay    : 1200,
});


// Toasts

function closeToast() {
  $( ".toast-style" ).hide();
}

var contactUsMessageSuccess = $('<div><h5>Уважаемые коллеги!</h5> <p>Ваша заявка получена, и принята в работу. В ближайшее время (не позднее 24 часов Вы получите ответ или готовое коммерческое предложение. В случае если оно Вас устроит, Вам будет выставлен официальный счет для оплаты.</p><p> С уважением коллектив ООО НДА Деловая медицинская компания</p><div><a href="#!" onclick="closeToast()" class=" modal-action modal-close waves-effect waves-blue btn-flat">Закрыть</a></div></div>');
var contactUsMessageError = $('<div><h5>Произошла ошибка!</h5> <p>Попробуйте еще раз.</p><div><a href="#!" onclick="closeToast()" class=" modal-action modal-close waves-effect waves-blue btn-flat">Закрыть</a></div></div>');

function sendLetter() {

  if ( $('#callback-bottom').is(":checked") && $( '#tel-bottom' ).val() == '' ) {
    $( '#tel-bottom' ).addClass('invalid');
    return false;
  }

  var mail = new Object;

  mail.type = "write-us-letter";

  mail.name = $( '#name-bottom' ).val();
  $( '#name-bottom' ).val('');

  mail.email = $( '#email-bottom' ).val();
  $( '#email-bottom' ).val('');

  mail.message = $( '#message-bottom' ).val();
  $( '#message-bottom' ).val('');

  mail.tel = $( '#tel-bottom' ).val();
  $( '#tel-bottom' ).val('');

  if( $('#callback-bottom').is(":checked") ) {
    mail.callback = true;
  } else {
    mail.callback = false;
  }
  $( '#callback-bottom' ).val('');

  $.ajax({
    url: '/wp-json/mail/send',
    type: 'POST',
    data: mail,
    success: function(){
      $('#send-letter-modal').closeModal();
      Materialize.toast(contactUsMessageSuccess, 20000, 'toast-style grey lighten-5');
    },
    error: function(){
      $('#send-letter-modal').closeModal();
      Materialize.toast(contactUsMessageError, 20000, 'toast-style grey lighten-5');
    }
  });

}

function contactUs() {

  if ( $('#callback').is(":checked") && $( '#tel' ).val() == '' ) {
    $( '#tel' ).addClass('invalid');
    return false;
  }

  var mail = new Object;

  mail.type = "contact-us";

  mail.name = $( '#name' ).val();
  $( '#name' ).val('');

  mail.email = $( '#email' ).val();
  $( '#email' ).val('');

  mail.message = $( '#message' ).val();
  $( '#message' ).val('');

  mail.tel = $( '#tel' ).val();
  $( '#tel' ).val('');

  if( $('#callback').is(":checked") ) {
    mail.callback = true;
  } else {
    mail.callback = false;
  }
  $( '#callback' ).val('');

  $.ajax({
    url: '/wp-json/mail/send',
    type: 'POST',
    data: mail,
    success: function(){
      $('#contactsModal').closeModal();
      Materialize.toast(contactUsMessageSuccess, 20000, 'toast-style grey lighten-5');
    },
    error: function(){
      $('#contactsModal').closeModal();
      Materialize.toast(contactUsMessageError, 20000, 'toast-style grey lighten-5');
    }
  });

}

// Validating forms

//Validating email in order modal

// var email = document.getElementById("email-order");
//
// email.addEventListener("keyup", function (event) {
//   if (email.validity.typeMismatch) {
//     email.setCustomValidity("Введите Ваш email");
//   } else {
//     email.setCustomValidity("");
//   }
// });

// Validate email in contactUsTop

var email = document.getElementById("email");

email.addEventListener("keyup", function (event) {
  if (email.validity.typeMismatch) {
    email.setCustomValidity("Введите Ваш email");
  } else {
    email.setCustomValidity("");
  }
});

// Validate email bottom

var email = document.getElementById("email-bottom");

email.addEventListener("keyup", function (event) {
  if (email.validity.typeMismatch) {
    email.setCustomValidity("Введите Ваш email");
  } else {
    email.setCustomValidity("");
  }
});
