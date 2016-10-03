<?php

get_header();

?>

    <div class="container">
        <nav class="breadcrumbs-wrapper">
            <div class="nav-wrapper">
                <div class="row">
                    <div class="col s11 offset-s1">
                        <a href="<?php echo home_url(); ?>" class="breadcrumb">Главная</a>
                        <a href="#" class="breadcrumb breadcrumb-active">Найти свою отгрузку</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="row">
            <div class="col s8 offset-s2">
                <div class="card product">
                    <div class="row">
                        <div class="text-align-center devider">
                            <h1 class="h1-for-groups-index product_title">Вход в личный кабинет <br><small>(для зарегистрированных пользователей)</small></h1>
                            <span>_______________</span>
                        </div>
                        <div class="row">
                            <form class="col s10 offset-s1">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="inn" type="text" class="validate">
                                        <label for="inn">Введите ИНН</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="password" type="password" class="validate">
                                        <label for="password">Введите пароль</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <button type="submit" class="btn waves-effect waves-light left blue log-in-btn">Войти
                                        <i class="material-icons right">border_color</i>
                                    </button>
                                    <!--<button type="submit" class="btn waves-effect waves-light right contacts-submit-btn blue">Подтвердить заказ
                                        <i class="material-icons right">send</i>
                                    </button>-->
                                    <a href="#" class="right forgot-pass"><span>Забыли пароль?</span></a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php get_footer(); ?>