<?php

function send_mail() {

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

    wp_mail( 'portex.nda@gmail.com', $_POST['name'], $_POST);
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
