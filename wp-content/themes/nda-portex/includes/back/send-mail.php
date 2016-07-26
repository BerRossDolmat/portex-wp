<?php

function send_mail() {

  if ($_POST['type'] === 'write-us-letter') {
    $type = 'Напишите нам';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $tel = $_POST['tel'];

    if ( $_POST['callback'] === 'true') {
      $callback = 'Да';
    } else {
      $callback = 'Нет';
    }
    $letter = '<div><h1>Сообщение с сайта Portex-NDA из формы "' . $type . '"</h1>'
            . '<p><b>Имя клиента:</b> ' . $name . '<br>'
            . '<b>Электронная почта:</b> ' . $email . '<br>'
            . '<b>Сообщение:</b><br>' . $message . '<br>'
            . '<b>Телефон:</b> ' . $tel . '<br>'
            . '<b>Перезвонить:</b> ' . $callback
            . '</p></div>';

    wp_mail( 'portex.nda@gmail.com', 'Написать письмо', $letter);
    return true;
  }

  if ($_POST['type'] === 'contact-us') {
    $type = 'Форма контактов';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $tel = $_POST['tel'];
    if ( $_POST['callback'] === 'true') {
      $callback = 'Да';
    } else {
      $callback = 'Нет';
    }
    $letter = '<div><h1>Сообщение с сайта Portex-NDA из формы "' . $type . '"</h1>'
            . '<p><b>Имя клиента:</b> ' . $name . '<br>'
            . '<b>Электронная почта:</b> ' . $email . '<br>'
            . '<b>Сообщение:</b><br>' . $message . '<br>'
            . '<b>Телефон:</b> ' . $tel . '<br>'
            . '<b>Перезвонить:</b> ' . $callback
            . '</p></div>';

    wp_mail( 'portex.nda@gmail.com', 'Форма контактов', $letter);
    return true;
  }

  return false;
}
