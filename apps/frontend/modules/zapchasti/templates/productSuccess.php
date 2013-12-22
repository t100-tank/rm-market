<?php $page = $sf_data->getRaw('page'); ?>
<?php $topCategory = $sf_data->getRaw('topCategory'); ?>
<?php $category = $sf_data->getRaw('category'); ?>
<?php $product = $sf_data->getRaw('product'); ?>
<?php include_component('home', 'breadcrumb', array('breadcrumb' => $breadcrumb)); ?>
<div class="content-static">
    <div class="wrap1 container">
        <?php include_partial('zapchasti/search', array('carLabelSlug' => $label->getSlug())); ?>
        <div class="row margin-bottom30 zapchasti">
            <div class="col-md-3 col-sm-3 col-xs-12 category-tree">
                <?php include_component('zapchasti', 'tree', array('carLabel' => $label->getSlug(), 'carLabelId' => $label->getId(), 'categoryId' => $product->getCategoryId())); ?>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <h1><?php echo is_object($page) ?
                        $page->getH1():
                        $product->getName(); ?></h1>
                <?php //echo is_object($page) ? $page->getBody(): ''; ?>
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <dl class="dl-horizontal product-attributes">
                            <dt>Артикул:</dt>
                            <dd><?php echo $product->getUid(); ?></dd>
                            <dt>Применяемость:</dt>
                            <dd><?php echo $product->getUsability(); ?></dd>
                            <?php if (is_object($page)) { ?>
                                <dt>Описание:</dt>
                                <dd><?php echo $page->getBody(); ?></dd>
                            <?php } ?>
                        </dl>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 item-holder">
                        <div class="product-margin">
                            Цена за единицу: <span class="product-price"><?php echo $product->getDistribPrice(); ?>р.</span>
                        </div>
                        <div class="product-margin">
                            Количество: <input type="text" name="amount" class="form-control amount-input" placeholder="1">
                        </div>
                        <a href="<?php echo url_for('zapchasti_add_to_cart', array(
                            'car_label' => $label->getSlug(),
                            'product' => $product->getSlug()
                        )); ?>" class="btn btn-danger col-md-6 col-sm-6 col-xs-6 to-cart add-from-product product-margin" title="Добавить в корзину">Купить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>