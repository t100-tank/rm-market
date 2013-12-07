<?php $tree = $sf_data->getRaw('tree'); ?>
<?php if (count($tree)) { ?>
    <ul class="top-list">
        <?php foreach ($tree as $item) { ?>
            <li class="top-item">
                <a href="<?php echo url_for('zapchasti_label_category', array('car_label' => $carLabel, 'category' => $item['slug'])); ?>"><?php echo $item['name'] ?></a>
                <?php if (count($item['sub_items'])) { ?>
                    <br/><ul class="sub-list">
                        <?php foreach ($item['sub_items'] as $subItem) { ?>
                            <li class="sub-item"><a href="<?php echo url_for('zapchasti_label_category', array('car_label' => $carLabel, 'category' => $subItem['slug'])); ?>"><?php echo $subItem['name'] ?></a></li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </li>
        <?php } ?>
    </ul>
<?php } ?>