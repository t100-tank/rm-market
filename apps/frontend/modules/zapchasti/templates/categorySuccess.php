<?php $page = $sf_data->getRaw('page'); ?>
<?php $topCategory = $sf_data->getRaw('topCategory'); ?>
<?php $category = $sf_data->getRaw('category'); ?>
<?php include_component('home', 'breadcrumb', array('breadcrumb' => $breadcrumb)); ?>
<div class="content-static">
    <div class="wrap1 container">
        <h1><?php echo is_object($page) ?
                $page->getH1():
                ( is_null($category) ? $topCategory->getName(): $category->getName()); ?></h1>
        <?php echo is_object($page) ? $page->getBody(): ''; ?>
        <div class="row margin-bottom10">

        </div>
    </div>
</div>