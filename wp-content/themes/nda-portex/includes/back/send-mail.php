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

    //wp_mail( $to, $subject, $message, $headers, $attachments );
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

      //wp_mail( $to, $subject, $message, $headers, $attachments );
      return true;
    }

    return false;
}
