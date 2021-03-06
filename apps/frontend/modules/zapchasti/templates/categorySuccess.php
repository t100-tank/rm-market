<?php $page = $sf_data->getRaw('page'); ?>
<?php $topCategory = $sf_data->getRaw('topCategory'); ?>
<?php $category = $sf_data->getRaw('category'); ?>
<?php include_component('home', 'breadcrumb', array('breadcrumb' => $breadcrumb)); ?>
<div class="content-static">
    <div class="wrap1 container">
        <?php include_partial('zapchasti/search', array('carLabelSlug' => $label->getSlug())); ?>
        <div class="row margin-bottom30 zapchasti">
            <div class="col-md-3 col-sm-3 col-xs-12 category-tree">
                <?php include_component('zapchasti', 'tree', array('carLabel' => $label->getSlug(), 'carLabelId' => $label->getId(), 'categoryId' => is_null($category) ? $topCategory->getId(): $category->getId() )); ?>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <h1><?php echo is_object($page) ?
                        $page->getH1():
                        ( is_null($category) ? $topCategory->getName(): $category->getName()); ?></h1>
                <?php echo is_object($page) ? $page->getBody(): ''; ?>
                <?php include_partial('zapchasti/list_pager', array(
                    'pager' => $pager,
                    'carLabel' => $label,
                    'routePrefix' => '@zapchasti_label_category_pager?car_label='.$label->getSlug().'&category='.( is_null($category) ? $topCategory->getSlug(): $category->getSlug() )
                )); ?>
            </div>
        </div>
    </div>
</div>