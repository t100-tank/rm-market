<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post" class="form-signin">
    <?php echo $form->renderHiddenFields(); ?>
    <h2 class="form-signin-heading">Вход</h2>
    <?php echo $form['username']->render(array('class' => 'form-control'.( $form['username']->hasError() ? ' error': '' ), 'placeholder' => 'пользователь')); ?>
    <?php echo $form['password']->render(array('class' => 'form-control'.( $form['password']->hasError() ? ' error': '' ), 'placeholder' => 'пароль')); ?>
    <label class="checkbox">
        <?php echo $form['remember']->render(); ?> запомнить меня
    </label>
    <?php echo (isset($form['_csrf_token'])) ? $form['_csrf_token']->render(): ''; ?>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Вход</button>
</form>
