<?php
$hasProducts = $sf_data->getRaw('hasProducts');
$products = $sf_data->getRaw('products');

include_component('home', 'breadcrumb', array('breadcrumb' => $breadcrumb));
?>
<div class="content-static">
    <div class="wrap1 container">
    	<h1>Оформление заказа</h1>
        <form action="<?php echo url_for('@form_action?slug='.$form->getName()); ?>" class="form-horizontal ajax-form" role="form" method="post">
            <div class="row margin-bottom30 order">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 class="panel-title">Для оформления заказа заполните свои контактные данные</h3>
                        </div>
                        <div class="panel-body order-form">
                                <?php include_partial('forms/fields', array('form' => $form)); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 class="panel-title">Мой заказ</h3>
                        </div>
                        <div class="panel-body order-list" data-url="<?php echo url_for('my_update_products'); ?>">
                            <?php include_partial('my/orderList', array(
                                'hasProducts' => $hasProducts,
                                'products' => $products
                            )); ?>
                        </div>
                    </div>
                    <div>
                        <a data-toggle="modal" href="<?php echo url_for('my_cart'); ?>" class="btn btn-info">Редактировать заказ</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12"><button type="submit" class="btn btn-danger">Оформить заказ</button></div>
            </div>
        </form>
    </div>
</div>