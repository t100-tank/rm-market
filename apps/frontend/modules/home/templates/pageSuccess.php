<?php $page = $sf_data->getRaw('page'); ?>
<?php include_partial('home/breadcrumb', array('breadcrumb' => $breadcrumb)); ?>
<div class="content-static">
    <div class="wrap1 container">
        <h1><?php echo $page->getH1(); ?></h1>
        <?php echo $page->getBody(); ?>
    </div>
</div>