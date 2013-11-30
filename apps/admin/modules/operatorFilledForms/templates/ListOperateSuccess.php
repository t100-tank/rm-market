<?php $filled = $sf_data->getRaw('filled'); ?>
<link rel="stylesheet" type="text/css" media="screen" href="/sfPropelPlugin/css/global.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/sfPropelPlugin/css/default.css" />
<div id="sf_admin_container">
    <h1>Обработка заказа от "<?php echo $filled->getName(); ?>" <small>(<?php echo $filled->getPhone(); ?>)</small></h1>
    <?php include_partial('operatorFilledForms/flashes'); ?>
    <div id="sf_admin_content">
        <div>
            <form class="form-horizontal" action="#" method="post" role="form">
                <div class="panel panel-default">
                    <div class="form-group<?php echo is_null($filled->getOperatorId()) ? ' has-warning': ''; ?>">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label" for="filled_form">Приемщик</label>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <p class="form-control-static"><?php echo (!is_null($filled->getsfGuardUser())) ? $filled->getsfGuardUser(): 'общая'; ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group<?php echo ($filled->getOperatorMailSent()) ? ' has-success': ' has-error'; ?>">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label" for="filled_form">E-mail приемщику</label>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <p class="form-control-static"><?php echo ($filled->getOperatorMailSent()) ? "+": "-"; ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group<?php echo ($filled->getUserMailSent()) ? ' has-success': ' has-warning'; ?>">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label" for="filled_form">E-mail заказчику</label>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <p class="form-control-static"><?php echo ($filled->getUserMailSent()) ? "+": "-"; ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group ">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label" for="filled_form">Имя (форма)</label>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <p class="form-control-static"><?php echo $filled->getName(); ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group ">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label" for="filled_form">E-mail (форма)</label>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <p class="form-control-static"><?php echo $filled->getEmail(); ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group ">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label" for="filled_form">Телефон (форма)</label>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <p class="form-control-static"><?php echo $filled->getPhone(); ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group ">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label" for="filled_form">Со страницы</label>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <p class="form-control-static"><?php echo $filled->getReferer(); ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group ">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label" for="filled_form">Данные формы</label>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <?php
                                $data = json_decode($filled->getData(), true);
                                if (is_array($data)) {
                                    $form = $filled->getServiceForm();
                                    foreach ($form->getFields() as $field) { ?>
                                        <div class="form-group has-warning">
                                            <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label" for="filled_form"><?php echo $field->getTitle(); ?></label>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                <p class="form-control-static"><?php 
                                                    $output = '';
                                                    if  (in_array($field->getType(), array('text', 'textarea', 'select', 'radio')) && isset($data[$field->getFieldName()])) {
                                                        $output = nl2br($data[$field->getFieldName()]);
                                                    } else if ($field->getType() == 'checkbox') {
                                                        $output = isset($data[$field->getFieldName()]) ? '+': '-';
                                                    } else if ($field->getType() == 'datepicker' && isset($data[$field->getFieldName()])) {
                                                        $output = nl2br($data[$field->getFieldName()]);
                                                        $tryDate = strtotime($data[$field->getFieldName()]);
                                                        if ($tryDate) {
                                                            $output = date("d.m.Y", $tryDate);
                                                        }
                                                    } else {
                                                        $output = "-//-";
                                                    }
                                                    echo $output;
//                                              ?></p>
                                            </div>
                                        </div>
                                    <?php }
                                }
                            ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group<?php echo ($filled->getIsClosed()) ? ' has-success': ' has-warning'; ?>">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label" for="filled_form">Закрыто</label>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <p class="form-control-static"><?php echo ($filled->getIsClosed()) ? '+': '-'; ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group ">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label" for="filled_form">Заметки</label>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <p class="form-control-static"><?php echo nl2br($filled->getNotes()); ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group ">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label" for="filled_form">Создано</label>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <p class="form-control-static"><?php echo $filled->getCreatedAt("d.m.Y H:i"); ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php if (!is_null($filled->getUpdatedAt())) { ?>
                    <div class="form-group ">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-12 control-label" for="filled_form">Обновлено</label>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <p class="form-control-static"><?php echo $filled->getUpdatedAt("d.m.Y H:i"); ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php } ?>
                </div>
                <ul class="sf_admin_actions">
                    <li class="sf_admin_action_list"><?php echo link_to('Вернуться к списку', '@filled_form_operatorFilledForms'); ?></li>
                    <?php if (!$filled->getIsClosed()) { ?>
                    <li class="sf_admin_action_edit"><?php echo link_to('Закрыть', '@filled_form_operator_change_status?id='.$filled->getId().'&setting=close', array('class' => 'operator-status-changer')); ?></li>
                    <?php } else { ?>
                    <li class="sf_admin_action_edit"><?php echo link_to('Открыть', '@filled_form_operator_change_status?id='.$filled->getId().'&setting=open', array('class' => 'operator-status-changer')); ?></li>
                    <?php } ?>
                    <?php if ($sf_user->getGuardUser()->hasPermission('forms')) { ?>
                    <li class="sf_admin_action_edit"><?php echo link_to('Сменить владельца', '@filled_form_operator_change_owner?id='.$filled->getId(), array('class' => 'operator-owner-changer')); ?></li>
                    <?php } ?>
                    <?php if ($sf_user->getGuardUser()->hasPermission('form_respondent')) { ?>
                    <li class="sf_admin_action_edit">
                        <?php if ($filled->getOperatorId() == $sf_user->getGuardUser()->getId()) { ?>
                            <?php echo link_to('Отказаться', '@filled_form_operator_unbind_owner?id='.$filled->getId()); ?>
                        <?php } else if (is_null($filled->getOperatorId())) { ?>
                            <?php echo link_to('Взяться', '@filled_form_operator_bind_owner?id='.$filled->getId()); ?>
                        <?php } ?>
                    </li>
                    <?php } ?>
                </ul>
            </form>
        </div>
    </div>
</div>