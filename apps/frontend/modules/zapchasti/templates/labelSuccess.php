<?php include_component('home', 'breadcrumb', array('breadcrumb' => $breadcrumb)); ?>
<div class="content-static">
    <div class="wrap1 container">
        <h1><?php echo is_object($page) ? $page->getH1(): 'Акции'; ?></h1>
        <?php echo is_object($page) ? $page->getBody(): ''; ?>
        <?php foreach ($list as $promo) { ?>
            <div class="row margin-bottom10">
                <div class="col-md-6 col-sm-6 col-xs-12 adv-img">
                    <a href="#"><img src="<?php echo $promo->getHtmlImagePath(); ?>" class="img-responsive"/></a>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <h2><a href="<?php echo url_for('@promotion?slug='.$promo->getSlug()); ?>"><?php echo $promo->getTitle(); ?></a></h2>
                    <?php echo $promo->getShortText(); ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>