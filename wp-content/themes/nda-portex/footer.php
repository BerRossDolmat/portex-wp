<!-- Footer -->

  <footer class="footer-style">
    <div class="container">
      <div class="padding-top text-align-center row">
        <p class="centered-text col s12 m4"> 2016 ООО "НДА Деловая медицинская компания"</p>
        <p class="centered-text col s12 m4">190121, Санкт-Петербург, ул. Перевозная, д. 6 (Матисов остров).</p>
        <p class="centered-text col s12 m4">Тел/факс: +7 (812) 714-0614</p>
      </div>
    </div>
  </footer>

  <!-- Contact-Btn -->
  <div class="contact-us-btn">
    <a class="btn-floating btn-large waves-effect waves-light blue lighten-2 tooltipped modal-trigger"
       data-position="left"
       data-delay="50"
       data-tooltip="Напишите нам"
       href="#send-letter-modal">
       <i class="material-icons">email</i>
    </a>
  </div>

  <!-- Send Letter Modal -->
  <div id="send-letter-modal" class="modal">
    <div class="modal-content">
      <form class="row" onsubmit="sendLetter();return false;">
        <div class="input-field col s12 m12">
          <input id="name-bottom" type="text" class="validate" required
            oninvalid="this.setCustomValidity('Представьтесь пожалуйста')"
            oninput="setCustomValidity('')"
          >
          <label for="name-bottom">Представьтесь пожалуйста</label>
        </div>
        <div class="input-field col s12 m12">
          <input id="email-bottom" type="email" class="validate" required
            oninvalid="this.setCustomValidity('Введите Ваш email')"
            oninput="setCustomValidity('')"
          >
          <label for="email-bottom">Ваш Email</label>
        </div>
        <div class="input-field col s12 m12">
          <textarea id="message-bottom" class="materialize-textarea" required
            oninvalid="this.setCustomValidity('Введите текст сообщения')"
            oninput="setCustomValidity('')"></textarea>
          <label for="message-bottom">Текст сообщения</label>
        </div>
        <div class="input-field col s12 m12">
          <input id="tel-bottom" type="tel" class="validate" placeholder="+7 XXX XXX-XX-XX">
          <label for="tel-bottom" class="active">Ваш номер телефона</label>
        </div>
        <div class="input-field col s12">
          <input type="checkbox" id="callback-bottom" />
          <label for="callback-bottom">Перезвоните мне</label>
        </div>
        <div class="input-field col s12">
          <button type="submit" class="btn waves-effect waves-light right contacts-submit-btn blue">Отправить письмо
            <i class="material-icons right">send</i>
          </button>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-blue btn-flat">Закрыть</a>
    </div>
  </div>

  <!-- Contact Us Top Modal -->

  <div id="contactsModal" class="modal">
    <div class="modal-content">
      <h4>Контакты</h4>
      <div class="row">
        <div class="col s8 offset-s2 m6 l4">
          <h5>Адрес офиса</h5>
          <p>
            190121,<br /> САНКТ-ПЕТЕРБУРГ, <br />
            ул. ПЕРЕВОЗНАЯ, д. 6 <br /> (Матисов остров).
          </p>
          <p> Тел.<a href="tel:+78127140614"> +7 (812) 714-0614 </a></p>
          <p> E-mail: <a href="mailto:nda@nda.ru">nda@nda.ru</a></p>
          <p><a href="https://yandex.ua/maps/2/saint-petersburg/?z=17&ll=30.27939349510259%2C59.923043442380866&l=map&origin=jsapi_2_1_41&from=api-maps&um=constructor%3ATg_88TxbGHE5vPCpmeoq17ndikm6ekVa&ncrnd=2804">Офис (карта Яндекса)</a></p>
          <p><a href="#">Скачать схему проезда</a></p>
        </div>
        <div class="col s8 offset-s2 m6 l4">
          <h5>Адрес склада</h5>
          <p>
            198099,<br /> САНКТ-ПЕТЕРБУРГ, <br />
            ул. Калинина, д. 39
          </p>
          <p> Тел.<a href="tel:+78127852039"> +7 (812) 785-2039 </a></p>
          <p> Факс.<a href="#"> +7 (812) 786-9019 </a></p>
          <p> E-mail: <a href="mailto:nda@nda.ru">nda@nda.ru</a></p>
          <p><a href="https://yandex.ua/maps/2/saint-petersburg/?z=17&ll=30.25155523066743%2C59.89647102433107&l=map&origin=jsapi_2_1_41&from=api-maps&um=constructor%3A9nPOjtuUz5IkjZbUjoDoh_C10t2U_y5Y">Склад (карта Яндекса)</a></p>
          <p><a href="#">Скачать схему проезда</a></p>
        </div>
        <div class="col m12 l4">

          <form class="row" onsubmit="contactUs();return false;">
            <div class="input-field col s12">
              <input id="name" type="text" class="validate" required
                oninvalid="this.setCustomValidity('Представьтесь пожалуйста')"
                oninput="setCustomValidity('')">
              <label for="name">Представьтесь пожалуйста</label>
            </div>
            <div class="input-field col s12">
              <input id="email" type="email" class="validate" required
                oninvalid="this.setCustomValidity('Введите Ваш email')"
                oninput="setCustomValidity('')">
              <label for="email">Ваш Email</label>
            </div>
            <div class="input-field col s12">
              <textarea id="message" class="materialize-textarea" required
                oninvalid="this.setCustomValidity('Введите текст сообщения')"
                oninput="setCustomValidity('')"
                ></textarea>
              <label for="message">Текст сообщения</label>
            </div>
            <div class="input-field col s12">
              <input id="tel" type="tel" class="validate" placeholder="+7 XXX XXX-XX-XX">
              <label for="tel" class="active">Ваш номер телефона</label>
            </div>
            <div class="input-field col s12">
              <input type="checkbox" id="callback" />
              <label for="callback">Перезвоните мне</label>
            </div>
            <div class="input-field col s12">
              <button type="submit" class="btn waves-effect waves-light right contacts-submit-btn blue">Отправить письмо
                <i class="material-icons right">send</i>
              </button>
            </div>
          </form>

        </div>
      </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-blue btn-flat">Закрыть</a>
    </div>
  </div>

  <?php wp_footer(); ?>

  </body>

</html>
