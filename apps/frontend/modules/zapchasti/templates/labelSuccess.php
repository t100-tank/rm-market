<?php $page = $sf_data->getRaw('page'); ?>
<?php $label = $sf_data->getRaw('label'); ?>
<?php include_component('home', 'breadcrumb', array('breadcrumb' => $breadcrumb)); ?>
<div class="content-static">
    <div class="wrap1 container">
        <h1><?php echo is_object($page) ? $page->getH1(): $label->getName(); ?></h1>
        <?php echo is_object($page) ? $page->getBody(): ''; ?>
        <div class="row margin-bottom10">

        </div>
    </div>
</div>