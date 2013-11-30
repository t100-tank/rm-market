<?php $page = $sf_data->getRaw('page'); ?>
<?php $promo = $sf_data->getRaw('promo'); ?>
<?php include_component('home', 'breadcrumb', array('breadcrumb' => $breadcrumb)); ?>
<div class="content-static">
    <div class="wrap1 container">
        <h1><?php echo is_object($page) ? $page->getH1(): $promo->getH1(); ?></h1>
        <?php echo is_object($page) ? $page->getBody(): ''; ?>
        <div class="row margin-bottom10">
            <div class="col-md-6 col-sm-6 col-xs-12 adv-img">
                <img src="<?php echo $promo->getHtmlImagePath(); ?>" class="img-responsive"/>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <h2><?php echo $promo->getTitle(); ?></h2>
                <?php echo $promo->getShortText(); ?>
            </div>
        </div>
        <?php echo $promo->getDescription(); ?>
    </div>
</div>