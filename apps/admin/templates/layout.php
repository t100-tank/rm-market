<!DOCTYPE html>
<html>
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <?php echo link_to($_SERVER['HTTP_HOST'], '@homepage', array('class' => 'navbar-brand')); ?>
                </div>
                <?php if ($sf_user->isAuthenticated()) { ?>
                <ul class="nav navbar-nav">
                    <?php if ($sf_user->getGuardUser()->hasPermission('users')) { echo '<li>' . link_to('Пользователи', '@sf_guard_user') . '</li>'; } ?>
                    <?php if ($sf_user->getGuardUser()->hasPermission('pages')) { echo '<li>' . link_to('Страницы', '@pages') . '</li>'; } ?>
                    <?php if ($sf_user->getGuardUser()->hasPermission('pages')) { echo '<li>' . link_to('Акции', '@advertise') . '</li>'; } ?>
                    <?php if ($sf_user->getGuardUser()->hasPermission('forms')) {
                        echo '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Формы <b class="caret"></b></a>';
                            echo '<ul class="dropdown-menu">';
                                echo '<li>'.link_to('Конструктор', '@service_form').'</li>';
                                echo '<li>'.link_to('Заполненые формы', '@filled_form').'</li>';
                            echo '</ul>';
                        echo '</li>';
                    } ?>
                    <?php if ($sf_user->getGuardUser()->hasPermission('form_respondent')) { echo '<li>' . link_to('Заявки', '@filled_form_operatorFilledForms') . '</li>'; } ?>
                    <?php if ($sf_user->getGuardUser()->hasPermission('zapchasti')) {
                        echo '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Запчасти <b class="caret"></b></a>';
                        echo '<ul class="dropdown-menu">';
                        echo '<li>'.link_to('Импорт/Экспорт', '@car_import_export').'</li>';
                        echo '<li>'.link_to('Марки', '@car_label').'</li>';
                        echo '<li>'.link_to('Категории', '@category').'</li>';
                        echo '</ul>';
                        echo '</li>';
                    } ?>
                </ul>
                <p class="navbar-text pull-right">&raquo; <?php echo $sf_user->getGuardUser()->getUsername(); ?>, <?php echo link_to('Выход', '@sf_guard_signout', array('class' => 'navbar-link')); ?></p>
                <?php } else { ?>
                <?php } ?>
            </div>
        </nav>
        <div class="container">
            <?php echo $sf_content ?>
        </div>
    </body>
</html>
