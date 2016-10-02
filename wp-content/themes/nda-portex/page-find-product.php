<?php

get_header();

?>

    <div class="container">
        <nav class="breadcrumbs-wrapper">
            <div class="nav-wrapper">
                <div class="row">
                    <div class="col s11 offset-s1">
                        <a href="<?php echo home_url(); ?>" class="breadcrumb">Главная</a>
                        <a href="#" class="breadcrumb breadcrumb-active">Найти продукцию</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="row">
            <div class="col s12">
                <div class="card product">
                    <div class="row">
                        <div class="text-align-center devider">
                            <h1 class="h1-for-groups-index product_title">Как найти продукцию</h1>
                            <span>_______________</span>
                        </div>
                        <div class="col s10 offset-s1">
                            <h4>Уважаемые коллеги!</h4>
                            <h4>Вариант 1.</h4>
                            <p>
                                На главной странице нашего сайта Вы найдете логотипы фирм наших поставщиков. 
                                Кликните по логотипу компании, войдите в группу товара, затем в подгруппу ( если такая имеется) 
                                и перейдите на страницу с описанием продукции, указанием кодов и размерного ряда.
                            </p>

                            <h4>Вариант 2.</h4>
                            <p>
Вы также можете воспользоваться окном поиска в верхней части сайта. Введите код продукции или название, поисковая система предоставит Вам варианты нашей продукции.
                            </p>
                            <h4>Вариант 3.</h4>
                            <p>
                            
Присылайте нам любые имеющиеся у Вас материалы ( описание, фото, словесные описания и пр.) Мы подберем наиболее подходящий для Вас вариант.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php get_footer(); ?>