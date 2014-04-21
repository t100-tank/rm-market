<?php $route = $sf_context->getInstance()->getRouting()->getCurrentRouteName(); ?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700&subset=latin,cyrillic-ext,latin-ext,cyrillic' rel='stylesheet' type='text/css'>
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
    </head>
    <body>
        <div class="main">
            <div class="container upper-spacer"></div>
            <div class="header">
                <div class="wrap1 container">
                    <div class="wrap2 container">
                        <div class="row" style="position:relative;">
                            <div class="col-md-4 col-sm-4 col-xs-12 header-logo">
                                <a href="<?php echo url_for("@homepage"); ?>" title="Главная"><img src="/images/logo.jpg" class="img-responsive" alt="RM-Market logo" /></a>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12 header-right">
                                <a href="#" id="favourites" rel="sidebar">Добавить в избранное</a><br/>
                                <span class="address"><strong>107497, Москва, Амурская ул., дом 5, стр.1</strong></span><br/>
                                <span class="tele ya-phone"><strong>+7(495)737-89-04</strong></span><br/>
                                <span class="schedule"><strong>c 9.00 до 21.00 без выходных</strong></span>
                            </div>
                            <div class="col-md-8 col-sm-12 col-xs-12 header-menu">
                                <nav class="navbar navbar-default" role="navigation">
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                            <span class="sr-only">Меню</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                    </div>
                                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                                        <ul class="nav navbar-nav navbar-right">
                                            <li><a href="<?php echo url_for("@homepage"); ?>" class="top-nav home">Главная</a></li>
                                            <li class="dropdown div">
                                                <a href="#" class="dropdown-toggle top-nav about" data-toggle="dropdown">О компании</a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="<?php echo url_for_ext('@content_page?slug=history/'); ?>">История</a></li>
                                                    <li><a href="/progress/">Карьера и вакансии</a></li>
                                                    <li><a href="/gallery/">Галерея</a></li>
                                                </ul>
                                            </li>
                                            <li class="div"><a href="/progress/" class="top-nav news">Новости</a></li>
                                            <li class="div"><a href="<?php echo url_for('@promotions'); ?>" class="top-nav promo">Акции</a></li>
                                            <li class="div"><a href="<?php echo url_for_ext('@content_page?slug=partners/'); ?>" class="top-nav partners">Партнеры</a></li>
                                            <li class="div"><a href="<?php echo url_for_ext('@content_page?slug=contact/'); ?>" class="top-nav contacts">Контакты</a></li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($route == 'homepage') { ?>
            <div class="home-slider">
                <div class="wrap1 container">
                    <div class="wrap2 row">
                        <div class="col-md-4 col-sm-4 col-xs-12 ext-menu">
                            <div class="sec-menu-item">
                                <a data-toggle="modal" href="<?php echo url_for('@form_show?slug=backCall'); ?>" class="phone">Заказать обратный звонок</a>
                            </div>
                            <div class="sec-menu-item">
                                <a data-toggle="modal" href="<?php echo url_for('@form_show?slug=appointment'); ?>" class="tablet">Запись на ремонт on-line</a>
                            </div>
                            <div class="sec-menu-item">
                                <a href="/avtozapchasti/" class="gears">Поиск автозапчастей</a>
                            </div>
                            <div class="sec-menu-item">
                                <a href="<?php echo url_for_ext('@content_page?slug=corporate/'); ?>" class="network">Корпоративным клиентам</a>
                            </div>
                        </div>
                        <div id="promotions" class="col-md-8 col-sm-8 col-xs-12 carousel slide">
                            <?php include_component('promotions', 'slider'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <a name="homeMenu"></a>
            <div class="home-menu">
                <div class="wrap1 container">
                    <div class="wrap2 row">
                        <div class="col-md-3 col-sm-6 col-xs-12 hm-item avtotehcentr">
                            <a name="homeMenuAvtotehcentr"></a>
                            <div class="item-wrap">
                                <div class="corner lt"></div>
                                <div class="corner lb"></div>
                                <div class="corner rt"></div>
                                <div class="corner rb"></div>
                                <a href="#homeMenuAvtotehcentr" class="view">
                                    <span class="img"></span>
                                    <span class="title">АВТОТЕХЦЕНТР</span>
                                    <span class="text">Специализированный технический центр РМ-Маркет выполняет ремонт и техническое обслуживание автомобилей</span>
                                </a>
                            </div>
                            <div class="slide">
                                <div class="arrow"></div>
                                <div class="subMenu">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3 col-xs-6 m-opel">
                                                <a href="/avtotehcenter/opel/" class="opel">
                                                    <img src="/images/menu/opel.png" title="opel" class="img-responsive"/>
                                                </a>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-6 m-chevrolet">
                                                <a href="/avtotehcenter/chevrolet/" class="chevrolet">
                                                    <img src="/images/menu/chevrolet.png" title="chevrolet" class="img-responsive"/>
                                                </a>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-6 m-cadillac">
                                                <a href="/avtotehcenter/cadillac/" class="cadillac">
                                                    <img src="/images/menu/cadillac.png" title="cadillac" class="img-responsive"/>
                                                </a>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-6 m-hummer">
                                                <a href="/avtotehcenter/hummer/" class="hummer">
                                                    <img src="/images/menu/hummer.png" title="hummer" class="img-responsive"/>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 hm-item avtosalon">
                            <a name="homeMenuAvtosalon"></a>
                            <div class="item-wrap">
                                <div class="corner lt"></div>
                                <div class="corner lb"></div>
                                <div class="corner rt"></div>
                                <div class="corner rb"></div>
                                <a href="#" class="view">
                                    <span class="img"></span>
                                    <span class="title">АВТОСАЛОН</span>
                                    <span class="text">Специализированный технический центр РМ-Маркет выполняет ремонт и техническое обслуживание автомобилей</span>
                                </a>
                            </div>
                            
                            <div class="slide">
                                <div class="arrow"></div>
                                <div class="subMenu">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-6 col-xs-12 u-item">
                                                <div class="corner lt"></div><div class="corner lb"></div><div class="corner rt"></div><div class="corner rb"></div>
                                                <a href="<?php echo url_for_ext('@content_page?slug=avtosalon/'); ?>" class="avtomobili-v-nalichii" title="Автомобили в наличии">
                                                    <span class="ico"></span>
                                                    <span class="name">Автомобили в наличии</span>
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12 u-item">
                                                <div class="corner lt"></div><div class="corner lb"></div><div class="corner rt"></div><div class="corner rb"></div>
                                                <a href="<?php echo url_for_ext('@content_page?slug=realizaciya/'); ?>" class="komissionnaya-realizaciya" title="Комиссионная реализация">
                                                    <span class="ico"></span>
                                                    <span class="name">Комиссионная реализация</span>
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12 u-item">
                                                <div class="corner lt"></div><div class="corner lb"></div><div class="corner rt"></div><div class="corner rb"></div>
                                                <a href="/progress/" class="kreditovanie" title="Кредитование">
                                                    <span class="ico"></span>
                                                    <span class="name">Кредитование</span>
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12 u-item">
                                                <div class="corner lt"></div><div class="corner lb"></div><div class="corner rt"></div><div class="corner rb"></div>
                                                <a href="/progress/" class="pereoformlenie" title="Переоформление">
                                                    <span class="ico"></span>
                                                    <span class="name">Переоформление</span>
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12 u-item">
                                                <div class="corner lt"></div><div class="corner lb"></div><div class="corner rt"></div><div class="corner rb"></div>
                                                <a href="<?php echo url_for_ext('@content_page?slug=vykup/'); ?>" class="vikup-avtomobiley" title="Выкуп автомобилей">
                                                    <span class="ico"></span>
                                                    <span class="name">Выкуп автомобилей</span>
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12 u-item">
                                                <div class="corner lt"></div><div class="corner lb"></div><div class="corner rt"></div><div class="corner rb"></div>
                                                <a href="/progress/" class="strahovanie" title="Страхование">
                                                    <span class="ico"></span>
                                                    <span class="name">Страхование</span>
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12 u-item">
                                                <div class="corner lt"></div><div class="corner lb"></div><div class="corner rt"></div><div class="corner rb"></div>
                                                <a href="<?php echo url_for_ext('@content_page?slug=tradein/'); ?>" class="trade-in" title="Trade-in">
                                                    <span class="ico"></span>
                                                    <span class="name">Trade-in</span>
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12 u-item">
                                                <div class="corner lt"></div><div class="corner lb"></div><div class="corner rt"></div><div class="corner rb"></div>
                                                <a href="<?php echo url_for_ext('@content_page?slug=podbor/'); ?>" class="pomosch-v-podbore" title="Помощь в подборе авто">
                                                    <span class="ico"></span>
                                                    <span class="name">Помощь в подборе авто</span>
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12 u-item">
                                                <div class="corner lt"></div><div class="corner lb"></div><div class="corner rt"></div><div class="corner rb"></div>
                                                <a href="/progress/" class="eu-us" title="Авто из США и Европы">
                                                    <span class="ico"></span>
                                                    <span class="name">Авто из США и Европы</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 hm-item line-spacer"></div>
                        <div class="col-md-3 col-sm-6 col-xs-12 hm-item avtozapchasti">
                            <a name="homeMenuAvtozapchasti"></a>
                            <div class="item-wrap">
                                <div class="corner lt"></div>
                                <div class="corner lb"></div>
                                <div class="corner rt"></div>
                                <div class="corner rb"></div>
                                <a href="#homeMenuAvtozapchasti" class="view">
                                    <span class="img"></span>
                                    <span class="title">АВТОЗАПЧАСТИ</span>
                                    <span class="text">Специализированный технический центр РМ-Маркет выполняет ремонт и техническое обслуживание автомобилей</span>
                                </a>
                            </div>
                            <div class="slide">
                                <div class="arrow"></div>
                                <div class="subMenu">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3 col-xs-6 m-opel">
                                                <a href="<?php echo url_for('zapchasti_label', array('car_label' => 'opel')); ?>" class="opel">
                                                    <img src="/images/menu/opel.png" title="opel" class="img-responsive"/>
                                                </a>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-6 m-chevrolet">
                                                <a href="<?php echo url_for('zapchasti_label', array('car_label' => 'chevrolet')); ?>" class="chevrolet">
                                                    <img src="/images/menu/chevrolet.png" title="chevrolet" class="img-responsive"/>
                                                </a>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-6 m-cadillac">
                                                <a href="<?php echo url_for('zapchasti_label', array('car_label' => 'cadillac')); ?>" class="cadillac">
                                                    <img src="/images/menu/cadillac.png" title="cadillac" class="img-responsive"/>
                                                </a>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-6 m-hummer">
                                                <a href="<?php echo url_for('zapchasti_label', array('car_label' => 'hummer')); ?>" class="hummer">
                                                    <img src="/images/menu/hummer.png" title="hummer" class="img-responsive"/>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 hm-item uslugi">
                            <a name="homeMenuUslugi"></a>
                            <div class="item-wrap">
                                <div class="corner lt"></div>
                                <div class="corner lb"></div>
                                <div class="corner rt"></div>
                                <div class="corner rb"></div>
                                <a href="#homeMenuUslugi" class="view">
                                    <span class="img"></span>
                                    <span class="title">УСЛУГИ</span>
                                    <span class="text">Специализированный технический центр РМ-Маркет выполняет ремонт и техническое обслуживание автомобилей</span>
                                </a>
                            </div>
                            <div class="slide">
                                <div class="arrow"></div>
                                <div class="subMenu">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-6 col-xs-12 u-item">
                                                <div class="corner lt"></div><div class="corner lb"></div><div class="corner rt"></div><div class="corner rb"></div>
                                                <a href="http://gbo-ustanovka.ru" class="ustanovka-gbo" title="Установка ГБО">
                                                    <span class="ico"></span>
                                                    <span class="name">Установка ГБО</span>
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12 u-item">
                                                <div class="corner lt"></div><div class="corner lb"></div><div class="corner rt"></div><div class="corner rb"></div>
                                                <a href="<?php echo url_for_ext('@content_page?slug=shinomontag/'); ?>" class="chip-tuning" title="Шиномонтаж">
                                                    <span class="ico"></span>
                                                    <span class="name">Шиномонтаж</span>
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12 u-item">
                                                <div class="corner lt"></div><div class="corner lb"></div><div class="corner rt"></div><div class="corner rb"></div>
                                                <a href="/progress/" class="kreditovanie" title="Кредитование">
                                                    <span class="ico"></span>
                                                    <span class="name">Кредитование</span>
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12 u-item">
                                                <div class="corner lt"></div><div class="corner lb"></div><div class="corner rt"></div><div class="corner rb"></div>
                                                <a href="/ustanovka_dop_oborudovaniya/" class="ustanovka-dop" title="Установка доп. оборудования">
                                                    <span class="ico"></span>
                                                    <span class="name">Установка доп. оборудования</span>
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12 u-item">
                                                <div class="corner lt"></div><div class="corner lb"></div><div class="corner rt"></div><div class="corner rb"></div>
                                                <a href="<?php echo url_for_ext('@content_page?slug=evakuator/'); ?>" class="evakuacija" title="Эвакуация">
                                                    <span class="ico"></span>
                                                    <span class="name">Эвакуация</span>
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12 u-item">
                                                <div class="corner lt"></div><div class="corner lb"></div><div class="corner rt"></div><div class="corner rb"></div>
                                                <a href="<?php echo url_for_ext('@content_page?slug=podbor/'); ?>" class="pomosch-v-podbore" title="Помощь в подборе авто">
                                                    <span class="ico"></span>
                                                    <span class="name">Помощь в подборе авто</span>
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12 u-item">
                                                <div class="corner lt"></div><div class="corner lb"></div><div class="corner rt"></div><div class="corner rb"></div>
                                                <a href="/progress/" class="sign-ohrana" title="Сигнализации и охранные системы">
                                                    <span class="ico"></span>
                                                    <span class="name">Сигнализации и охранные системы</span>
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12 u-item">
                                                <div class="corner lt"></div><div class="corner lb"></div><div class="corner rt"></div><div class="corner rb"></div>
                                                <a href="<?php echo url_for_ext('@content_page?slug=carwash/'); ?>" class="avtomoyka" title="Автомойка">
                                                    <span class="ico"></span>
                                                    <span class="name">Автомойка</span>
                                                </a>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12 u-item">
                                                <div class="corner lt"></div><div class="corner lb"></div><div class="corner rt"></div><div class="corner rb"></div>
                                                <a href="/progress/" class="predprodazhnaya-podgotovka" title="Предпродажная подготовка">
                                                    <span class="ico"></span>
                                                    <span class="name">Предпродажная подготовка</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } else { ?>
            <div class="second-menu">
                <div class="wrap1 container">
                    <div class="wrap2 row">
                        <div class="col-md-3 col-sm-6 col-xs-12 sec-menu-item">
                            <a data-toggle="modal" href="<?php echo url_for('@form_show?slug=backCall'); ?>" class="phone">Заказать обратный звонок</a>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 sec-menu-item">
                            <a data-toggle="modal" href="<?php echo url_for('@form_show?slug=appointment'); ?>" class="tablet">Запись на ремонт on-line</a>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 sec-menu-item">
                            <a href="/avtozapchasti/" class="gears">Поиск автозапчастей</a>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12 sec-menu-item">
                            <a href="<?php echo url_for_ext('@content_page?slug=corporate/'); ?>" class="network">Корпоративным клиентам</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php echo $sf_content; ?>
            <?php /* ?>
            <div class="content-static">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-12 model-point-area">
                            <a href="#" style="position:absolute;bottom:76%;left:5%;">Ремонт двигателя</a>
                            <a href="#" style="position:absolute;top:67%;left:3%;">Ремонт электрики</a>
                            <a href="#" style="position:absolute;top:81%;right:4%;">Развал схождение</a>
                            <a href="#" style="position:absolute;top:54%;right:4%;">Ремонт подвески</a>
                            <img src="/uploads/opel-pointed.jpg" class="img-responsive"/>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <ul>
                                <li><a href="#">Ремонт двигателя</a></li>
                                <li><a href="#">Ремонт электрики</a></li>
                                <li><a href="#">Развал схождение</a></li>
                                <li><a href="#">Ремонт подвески</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <p>Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты. Вдали от всех живут они в буквенных домах на берегу Семантика большого языкового океана. Маленький ручеек Даль журчит по всей стране и обеспечивает ее всеми необходимыми правилами. Эта парадигматическая страна, в которой жаренные члены предложения залетают прямо в рот.</p>
                            <p>Даже всемогущая пунктуация не имеет власти над рыбными текстами, ведущими безорфографичный образ жизни. Однажды одна маленькая строчка рыбного текста по имени Lorem ipsum решила выйти в большой мир грамматики. Великий Оксмокс предупреждал ее о злых запятых, диких знаках вопроса и коварных точках с запятой, но текст не дал сбить себя с толку. Он собрал семь своих заглавных букв, подпоясал инициал за пояс и пустился в дорогу.</p>
                            <p>Взобравшись на первую вершину курсивных гор, бросил он последний взгляд назад, на силуэт своего родного города Буквоград, на заголовок деревни Алфавит и на подзаголовок своего переулка Строчка. Грустный реторический вопрос скатился по его щеке и он продолжил свой путь. По дороге встретил текст рукопись. Она предупредила его: «В моей стране все переписывается по несколько раз. Единственное, что от меня осталось, это приставка «и».</p>
                            <p>Возвращайся ты лучше в свою безопасную страну». Не послушавшись рукописи, наш текст продолжил свой путь. Вскоре ему повстречался коварный составитель рекламных текстов, напоивший его языком и речью и заманивший в свое агенство, которое использовало его снова и снова в своих проектах. И если его не переписали, то живет он там до сих пор. Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты. Вдали от всех живут они в буквенных домах на берегу Семантика большого языкового океана. Маленький ручеек Даль журчит по всей стране и обеспечивает ее всеми необходимыми правилами. Эта парадигматическая страна, в которой жаренные члены предложения залетают прямо в рот. Даже всемогущая пунктуация не имеет власти над рыбными текстами, ведущими безорфографичный образ жизни. Однажды одна маленькая</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php */ ?>
        </div>
        <div class="footer">
            <div class="footer-top">
                <div class="wrap1 container">
                    <div class="wrap2 container">
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <ul class="nav">
                                    <li><a href="<?php echo url_for('@homepage'); ?>">Главная</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">О компании</a>
                                        <ul class="dropdown-menu">
                                            <li><a tabindex="-1" href="<?php echo url_for_ext('@content_page?slug=history/'); ?>">История</a></li>
                                            <li><a tabindex="-1" href="#">Карьера и вакансии</a></li>
                                            <li><a tabindex="-1" href="<?php echo url_for_ext('@content_page?slug=gallery/'); ?>">Галерея</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="/progress/">Новости</a></li>
                                    <li><a href="<?php echo url_for('@promotions'); ?>">Акции</a></li>
                                    <li><a href="<?php echo url_for_ext('@content_page?slug=partners/'); ?>">Партнеры</a></li>
                                    <li><a href="<?php echo url_for_ext('@content_page?slug=contact/'); ?>">Контакты</a></li>
                                    <li><a data-toggle="modal" href="<?php echo url_for('@form_show?slug=backCall'); ?>">Заказать обратный звонок</a></li>
                                    <li><a data-toggle="modal" href="<?php echo url_for('@form_show?slug=appointment'); ?>">Запись на ремонт on-line</a></li>
                                    <li><a href="<?php echo url_for_ext('@content_page?slug=technichesky-likbez/'); ?>">Технический ликбез</a></li>
                                    <li><a href="<?php echo url_for_ext('@content_page?slug=avtozapchasti/'); ?>">Поиск автозапчастей</a></li>
                                    <li><a href="<?php echo url_for_ext('@content_page?slug=corporate/'); ?>">Корпоративным клиентам</a></li>
                                    <li><a href="<?php echo url_for_ext('@content_page?slug=auxpage_cafe/'); ?>">Кафе</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <ul>
                                    <li>АВТОТЕХЦЕНТР</li>
                                    <li class="smaller">&gt; <a href="/avtotehcenter/opel/">Opel</a></li>
                                    <li class="smaller">&gt; <a href="/avtotehcenter/chevrolet/">Chevrolet</a></li>
                                    <li class="smaller">&gt; <a href="/avtotehcenter/cadillac/">Cadillac</a></li>
                                    <li class="smaller">&gt; <a href="/avtotehcenter/hummer/">Hummer</a></li>
                                    <li>АВТОСАЛОН</li>
                                    <li class="smaller">&gt; <a href="<?php echo url_for_ext('@content_page?slug=avtosalon/'); ?>">Автомобили в наличии</a></li>
                                    <li class="smaller">&gt; <a href="<?php echo url_for_ext('@content_page?slug=realizaciya/'); ?>">Комиссионная реализация</a></li>
                                    <li class="smaller">&gt; <a href="/progress/">Кредитование</a></li>
                                    <li class="smaller">&gt; <a href="/progress/">Преоформление</a></li>
                                    <li class="smaller">&gt; <a href="<?php echo url_for_ext('@content_page?slug=vykup/'); ?>">Выкуп автомобилей</a></li>
                                    <li class="smaller">&gt; <a href="/progress/">Страхование</a></li>
                                    <li class="smaller">&gt; <a href="<?php echo url_for_ext('@content_page?slug=tradein/'); ?>/">Trade-in</a></li>
                                    <li class="smaller">&gt; <a href="<?php echo url_for_ext('@content_page?slug=podbor/'); ?>">Помощь в подборе авто</a></li>
                                    <li class="smaller">&gt; <a href="/progress/">Авто из США и Европы</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <ul>
                                    <li>АВТОЗАПЧАСТИ</li>
                                    <li class="smaller">&gt; <a href="<?php echo url_for('@zapchasti_label?car_label=opel'); ?>">Opel</a></li>
                                    <li class="smaller">&gt; <a href="<?php echo url_for('@zapchasti_label?car_label=chevrolet'); ?>">Chevrolet</a></li>
                                    <li class="smaller">&gt; <a href="<?php echo url_for('@zapchasti_label?car_label=cadillac'); ?>">Cadillac</a></li>
                                    <li class="smaller">&gt; <a href="<?php echo url_for('@zapchasti_label?car_label=hummer'); ?>">Hummer</a></li>
                                    <li>УСЛУГИ</li>
                                    <li class="smaller">&gt; <a href="http://gbo-ustanovka.ru">Установка ГБО</a></li>
                                    <li class="smaller">&gt; <a href="<?php echo url_for_ext('@content_page?slug=shinomontag/'); ?>">Шиномонтаж</a></li>
                                    <li class="smaller">&gt; <a href="/progress/">Кредитование</a></li>
                                    <li class="smaller">&gt; <a href="<?php echo url_for_ext('@content_page?slug=ustanovka_dop_oborudovaniya/'); ?>">Установка доп. оборудования</a></li>
                                    <li class="smaller">&gt; <a href="<?php echo url_for_ext('@content_page?slug=evakuator/'); ?>">Эвакуация</a></li>
                                    <li class="smaller">&gt; <a href="<?php echo url_for_ext('@content_page?slug=podbor/'); ?>">Помощь в подборе авто</a></li>
                                    <li class="smaller">&gt; <a href="/progress/">Сигнализация и охранные системы</a></li>
                                    <li class="smaller">&gt; <a href="<?php echo url_for_ext('@content_page?slug=carwash/'); ?>">Автомойка</a></li>
                                    <li class="smaller">&gt; <a href="/progress/">Предпродажная подготовка</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <ul>
                                    <li>107497, Москва</li>
                                    <li>Амурская ул., дом 5, стр.1</li>
                                    <li class="tele ya-phone">+7(495)737-89-04</li>
                                    <li class="social">
                                        <a class="fb" href="http://facebook.com/"></a><a class="vk" href="http://vk.com/"></a><a class="gp" href="http://plus.google.com/"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">&copy; Автотехцентр <?php echo $_SERVER['SERVER_NAME']; ?> 2013</div>
                        <div class="col-md-6 col-sm-6 col-xs-6">Design &amp; Development <a href="http://artsvitlyna.com/">ArtSvitlyna</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal"></div>
        <?php if ($sf_request->getHost() == 'rm-market.ru' || $sf_request->getHost() == 'www.rm-market.ru') { ?>
            <script type="text/javascript">

                var _gaq = _gaq || [];
                _gaq.push(['_setAccount', 'UA-45806375-1']);
                _gaq.push(['_trackPageview']);

                (function() {
                    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
                })();

            </script>
            <!-- Yandex.Metrika counter -->
            <script type="text/javascript">
            (function (d, w, c) {
                (w[c] = w[c] || []).push(function() {
                    try {
                        w.yaCounter24591170 = new Ya.Metrika({id:24591170,
                                webvisor:true,
                                clickmap:true,
                                trackLinks:true,
                                accurateTrackBounce:true});
                    } catch(e) { }
                });

                var n = d.getElementsByTagName("script")[0],
                    s = d.createElement("script"),
                    f = function () { n.parentNode.insertBefore(s, n); };
                s.type = "text/javascript";
                s.async = true;
                s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else { f(); }
            })(document, window, "yandex_metrika_callbacks");
            </script>
            <noscript><div><img src="//mc.yandex.ru/watch/24591170" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
            <!-- /Yandex.Metrika counter -->
        <?php } ?>
    </body>
</html>