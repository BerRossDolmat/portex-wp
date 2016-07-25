<?php

function send_mail() {
  $type = 'asd';
  if ( $_POST['type'] === 'write-us-letter') {
    $type = 'Напишите нам';
  }

  if ($_POST['type'] === 'write-us-letter') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $tel = $_POST['tel'];
    if ( $_POST['callback'] === true) {
      $callback = 'Да';
    } else {
      $callback = 'Нет';
    }
    $letter = '<div><h1>Сообщение с сайта Portex-NDA из формы "' . $type . '"</h1>';
    // $letter += '<p><b>Имя клиента:</b> ' . $name . '<br>';
    // $letter += '<b>Электронная почта:</b> ' . $email . '<br>';
    // $letter += '<b>Сообщение:</b><br>' . $message . '<br>';
    // $letter += '<b>Телефон:</b> ' . $tel . '<br>';
    // $letter += '<b>Перезвонить:</b> ' . $callback;
    // $letter += '</p></div>';
    wp_mail( 'portex.nda@gmail.com', 'Call-us-form', $letter);
    return true;
  }

  if ($_POST['type'] === 'contact-us') {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $message = $_POST['message'];
      $tel = $_POST['tel'];
      if ( $_POST['callback'] === true) {
        $callback = 'Да';
      } else {
        $callback = 'Нет';
      }

      wp_mail( 'portex.nda@gmail.com', $_POST['name'], $_POST);
      return true;
    }

    return false;
}
