<div>
    <form class="form-horizontal" action="<?php echo url_for('@filled_form_operator_change_owner?id='.$filled->getId()); ?>" method="post" role="form">
        <div class="form-group">
            <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12 control-label" for="filled_form">Приемщик</label>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <select name="operator_id" class="form-control">
                    <option value="">общая</option>
                    <?php foreach ($opList as $op) { ?>
                    <option value="<?php echo $op->getId(); ?>"<?php if ($op->getId() == $filled->getOperatorId()) {echo ' selected="selected"';} ?>><?php echo $op->getUsername(); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-default pull-right">Сменить</button>
            </div>
            <div class="clearfix"></div>
        </div>
    </form>
</div>