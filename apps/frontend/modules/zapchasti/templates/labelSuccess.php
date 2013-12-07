<?php $page = $sf_data->getRaw('page'); ?>
<?php $label = $sf_data->getRaw('label'); ?>
<?php include_component('home', 'breadcrumb', array('breadcrumb' => $breadcrumb)); ?>
<div class="content-static">
    <div class="wrap1 container">
        <h1><?php echo is_object($page) ? $page->getH1(): $label->getName(); ?></h1>
        <?php echo is_object($page) ? $page->getBody(): ''; ?>
        <div class="row margin-bottom10">
            <div class="category-tree">
                <?php include_component('zapchasti', 'tree', array('carLabel' => $label->getSlug(), 'carLabelId' => $label->getId())); ?>
            </div>
        </div>
    </div>
</div>