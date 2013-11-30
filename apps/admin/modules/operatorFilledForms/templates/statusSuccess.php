<?php $filled = $sf_data->getRaw('filled'); ?>
<div>
    <h4>Пометить как "<?php echo ($filled->getIsClosed()) ? 'закрытую': 'открытую'; ?>".</h4>
    <form action="<?php echo url_for('@filled_form_operator_change_status?id='.$filled->getId().'&setting='.( $filled->getIsClosed() ? 'close': 'open' )); ?>" class="form-horizontal" role="form" method="post">
        <?php echo $form->renderHiddenFields(); ?>
        <div class="form-group">
            <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label" for="filled_form">Пометка</label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <?php echo $form['notes']->render(); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-default pull-right"><?php echo ($filled->getIsClosed()) ? 'Закрыть': 'Открыть'; ?></button>
            </div>
        </div>
    </form>
</div>