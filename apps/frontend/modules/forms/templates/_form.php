<div class="modal fade" id="<?php echo $form->getName(); ?>" tabindex="-1" role="dialog" aria-labelledby="modalLable<?php echo $form->getName(); ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php echo $form->getTitle(); ?></h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo url_for('@form_action?slug='.$form->getName()); ?>" class="form-horizontal ajax-form" role="form" method="post">
                        <?php include_partial('forms/fields', array('form' => $form)); ?>
                        <?php /* ?>
                        <?php foreach ($form->getOrderedFields() as $field) { ?>
                        <div class="form-group">
                            <label for="form[<?php echo $field->getFieldName(); ?>]" class="col-lg-4 control-label"><?php echo $field->getTitle(); ?></label>
                            <div class="col-lg-8">
                                <?php switch ($field->getType()) {
                                    case 'checkbox':
                                        echo '<input type="checkbox" class="form-control" id="input'.$form->getId().$field->getFieldName().'" name="form['.$field->getFieldName().']"/>';
                                        if ($field->getTip()) { echo '<span class="help-block">'.$field->getTip().'</span>'; }
                                        break;
                                    case 'textarea':
                                        echo '<textarea class="form-control" id="input'.$form->getId().$field->getFieldName().'" name="form['.$field->getFieldName().']"></textarea>';
                                        if ($field->getTip()) { echo '<span class="help-block">'.$field->getTip().'</span>'; }
                                        break;
                                    case 'select':
                                        $variants = Common::quotJsonFix($field->getVariants());
                                        $variants = json_decode($variants);
                                        if (is_array($variants)) {
                                            echo '<select class="form-control" id="input'.$form->getId().$field->getFieldName().'" name="form['.$field->getFieldName().']">';
                                            foreach ($variants as $variant) {
                                                echo '<option value="'. str_replace('"', '&quot;', $variant).'">'.$variant.'</option>';
                                            }
                                            echo '</select>';
                                        }
                                        if ($field->getTip()) { echo '<span class="help-block">'.$field->getTip().'</span>'; }
                                        break;
                                    case 'radio':
                                        $variants = Common::quotJsonFix($field->getVariants());
                                        $variants = json_decode($variants);
                                        if (is_array($variants)) {
                                            foreach ($variants as $variant) {
                                                echo '<div><input type="radio" name="form['.$field->getFieldName().']" id="input'.$form->getId().$field->getFieldName().'" value="'. str_replace('"', '&quot;', $variant).'"> '.$variant.'</div>';
                                            }
                                        }
                                        if ($field->getTip()) { echo '<span class="help-block">'.$field->getTip().'</span>'; }
                                        break;
                                    case 'datepicker':
                                        echo '<input type="text" class="form-control datepicker" id="input'.$form->getId().$field->getFieldName().'" name="form['.$field->getFieldName().']" placeholder="'.$field->getTip().'"/>';
                                        break;
                                    case 'text':
                                    case 'datepicker':
                                    default: 
                                        echo '<input type="text" class="form-control'.( $field->getType() == 'datepicker' ? ' datepicker': '' ).'" id="input'.$form->getId().$field->getFieldName().'" name="form['.$field->getFieldName().']" placeholder="'.$field->getTip().'"/>';
                                        break;
                                } ?>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <label for="form[chcode]" class="col-lg-4 control-label"><a href="#" id="chcodeRefresh" rel="<?php echo url_for('@form_chcode'); ?>" title="Обновить изображение"><img src="<?php echo url_for('@form_chcode'); ?>?_=<?php echo time(); ?>"/></a></label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" id="input<?php echo $form->getId(); ?>chcode" name="form[chcode]" placeholder="xxxx"/>
                            </div>
                        </div>
                        <?php */ ?>
                        <div class="t-align-right"><button type="submit" class="btn btn-primary">Отправить</button></div>
                    </form>
                </div>
                <?php /* ?><div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div><?php */ ?>
            </form>
        </div>
    </div>
</div>