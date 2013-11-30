<?php $bcList = $sf_data->getRaw('breadcrumb'); ?>
<?php if (!empty($bcList) && is_array($bcList)) { ?>
<div class="breadcrumb-placeholder">
    <div class="wrap1 container">
        <div class="wrap2 container">
            <ol class="breadcrumb">
                <?php foreach ($bcList as $item) { ?>
                <li<?php echo (empty($item['link'])) ? ' class="active"': ''; ?>><?php echo (!empty($item['link'])) ? link_to($item['title'], $item['link']): $item['title']; ?></li>
                <?php } ?>
            </ol>
        </div>
    </div>
</div>
<?php } ?>