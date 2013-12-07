<?php $page = $sf_data->getRaw('page'); ?>
<?php $label = $sf_data->getRaw('label'); ?>
<?php include_component('home', 'breadcrumb', array('breadcrumb' => $breadcrumb)); ?>
<div class="content-static">
    <div class="wrap1 container">
        <?php include_partial('zapchasti/search', array('carLabelSlug' => $label->getSlug())); ?>
        <div class="row margin-bottom30 zapchasti">
            <div class="col-md-3 col-sm-3 col-xs-12 category-tree">
                <?php include_component('zapchasti', 'tree', array('carLabel' => $label->getSlug(), 'carLabelId' => $label->getId(), 'categoryId' => null)); ?>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <h1><?php echo is_object($page) ? $page->getH1(): $label->getName(); ?></h1>
                <?php echo is_object($page) ? $page->getBody(): ''; ?>
                <?php include_partial('zapchasti/list_pager', array(
                    'pager' => $pager,
                    'carLabel' => $label,
                    'routePrefix' => '@zapchasti_label_search_pager?car_label='.$label->getSlug()
                )); ?>
            </div>
        </div>
    </div>
</div>