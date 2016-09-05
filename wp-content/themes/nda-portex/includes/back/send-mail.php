<?php

// Send emails function
function send_mail() {

  // Check email type
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

    // Create letter
    $letter = '<div><h1>Сообщение с сайта Portex-NDA из формы "' . $type . '"</h1>'
            . '<p><b>Имя клиента:</b> ' . $name . '<br>'
            . '<b>Электронная почта:</b> ' . $email . '<br>'
            . '<b>Сообщение:</b><br>' . $message . '<br>'
            . '<b>Телефон:</b> ' . $tel . '<br>'
            . '<b>Перезвонить:</b> ' . $callback
            . '</p></div>';

    // Send letter
    wp_mail( 'portex.nda@gmail.com', 'Написать письмо', $letter);
    return true;
  }

  // Check email type
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

    // Create letter
    $letter = '<div><h1>Сообщение с сайта Portex-NDA из формы "' . $type . '"</h1>'
            . '<p><b>Имя клиента:</b> ' . $name . '<br>'
            . '<b>Электронная почта:</b> ' . $email . '<br>'
            . '<b>Сообщение:</b><br>' . $message . '<br>'
            . '<b>Телефон:</b> ' . $tel . '<br>'
            . '<b>Перезвонить:</b> ' . $callback
            . '</p></div>';

    // Send letter
    wp_mail( 'portex.nda@gmail.com', 'Форма контактов', $letter);
    return true;
  }

  if ($_POST['type'] === 'new-order') {
    $type = 'Новый заказ';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $tel = $_POST['tel'];
    $tables = '';
    $body = json_decode(stripslashes($_POST['body']));

    foreach($body as $key => $value)
    {
      $tables .= '<table style="border: 1px solid black; width: 100%">' . $value . '</table>';
    }

    // Create letter
    $letter = '<div><h1>Новый заказ с сайта Portex-NDA со страницы товара "' . $_POST['title'] . '"</h1>'
            . '<p><b>Имя клиента:</b> ' . $name . '<br>'
            . '<b>Электронная почта:</b> ' . $email . '<br>'
            . '<b>Сообщение:</b><br>' . $message . '<br>'
            . '<b>Телефон:</b> ' . $tel . '<br>'
            . '</p></div>'
            . '<div>' . $tables . '</div>';

    // Send letter
    wp_mail( 'portex.nda@gmail.com', 'Новый заказ', $letter);
    return true;
  }

  return false;
}
