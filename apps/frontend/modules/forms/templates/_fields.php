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