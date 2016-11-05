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
    wp_mail( 'portex.nda@gmail.com', 'Написать письмо', $letter );

    $letter = '<div><h1>Уважаемые коллеги!</h1>'
      . '<p>Благодарим вас за обращение в ООО НДА"Деловая медицинская компания" '
      . 'Ваше письмо получено и поступило в обработку. В ближайшее время, не позднее 24 часов, Вы получите ответ, ' 
      . 'либо наши сотрудники свяжутся с Вами для уточнения Вашего заказа.</p>'
      . '<p>С уважение коллектив НДА</p></div>';
      
    wp_mail( $email, 'Спасибо за Ваше обращение', $letter );

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

    $letter = '<div><h1>Уважаемые коллеги!</h1>'
      . '<p>Благодарим вас за обращение в ООО НДА"Деловая медицинская компания" '
      . 'Ваше письмо получено и поступило в обработку. В ближайшее время, не позднее 24 часов, Вы получите ответ, ' 
      . 'либо наши сотрудники свяжутся с Вами для уточнения Вашего заказа.</p>'
      . '<p>С уважение коллектив НДА</p></div>';

    wp_mail( $email, 'Спасибо за Ваше обращение', $letter );
    
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
    if(isset($_FILES['file'])) {
      rename($_FILES['file']['tmp_name'], $_FILES['file']['name']);
    }
    foreach($body as $key => $value)
    {
      $tables .= $value;
    }

    // Create letter
    $letter = '<div><h1>Новый заказ с сайта Portex-NDA со страницы товара "' . $_POST['title'] . '"</h1>'
            . '<p><b>Имя клиента:</b> ' . $name . '<br>'
            . '<b>Электронная почта:</b> ' . $email . '<br>'
            . '<b>Сообщение:</b><br>' . $message . '<br>'
            . '<b>Телефон:</b> ' . $tel . '<br>'
            . '<b>Имя товара:</b> ' . $_POST['title'] . '<br>'
            . '</p></div>'
            . '<div>' . $tables . '</div>';

    // Send letter
    if(isset($file)) {
      wp_mail( 'portex.nda@gmail.com', 'Новый заказ', $letter, '', $_FILES['file']);
    } else {
      wp_mail( 'portex.nda@gmail.com', 'Новый заказ', $letter);
    }
    

    $letter = '<div><h1>Уважаемые коллеги!</h1>'
      . '<p>Мы благодарны Вам, что Вы обратились в ООО "НДА Деловая медицинская компания". ' 
      . 'Ваш заказ получен и поступил в обработку. В течение 24 часов Вы получите от нас коммерческое предложение. '
      . 'Или наши сотрудники свяжутся с Вами для уточнения деталей заказа.</p> ' 
      . '<p>Обращаем Ваше внимание, что Коммерческое предложение не является официальным счетом!!! '
      . 'Счет будет выставлен  Вам отдельно после согласования скидок и условий оплаты.';

      wp_mail( $email, 'Спасибо за заказ', $letter );

    return true;
  }

  return false;
}
