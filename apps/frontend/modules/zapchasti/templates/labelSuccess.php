<?php include_component('home', 'breadcrumb', array('breadcrumb' => $breadcrumb)); ?>
<div class="content-static">
    <div class="wrap1 container">
        <h1><?php echo is_object($page) ? $page->getH1(): 'Запчасти'; ?></h1>
        <?php echo is_object($page) ? $page->getBody(): ''; ?>
    </div>
</div>