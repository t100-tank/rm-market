<div class="col-md-12 col-sm-12 col-xs-12 cart-holder"<?php if (!$sf_user->hasAttribute('cart')) { echo ' style="display: none;"'; } ?>>
    <a data-toggle="modal" href="<?php echo url_for('my_cart'); ?>" class="btn btn-lg btn-danger" id="cartButton" >Корзина <span>(<?php echo count($sf_user->getAttribute('cart')); ?>)</span></a>
</div>
<?php $tree = $sf_data->getRaw('tree'); ?>
<?php if (count($tree)) { ?>
    <ul class="top-list">
        <?php foreach ($tree as $item) { ?>
            <?php
            $subList = '';
            $matched = false;
            if (count($item['sub_items'])) {
                $subList .= '<br/><ul class="sub-list">';
                foreach ($item['sub_items'] as $subItem) {
                    $matched |= $subItem['id'] == $categoryId;
                    $subList .= '<li class="sub-item">&rsaquo; <a class="sub-link'.($subItem['id'] == $categoryId ? ' selected': '').'" href="'.url_for('zapchasti_label_category', array('car_label' => $carLabel, 'category' => $subItem['slug'])).'">'.$subItem['name'].'</a></li>';
                }
                $subList .= '</ul>';
            }
            $matched |= $item['id'] == $categoryId;
            ?>
            <li class="top-item<?php echo $matched ? ' toggled': ''; ?>">
                <a class="top-link<?php echo $matched ? ' pre-selected selected': ''; ?>" href="<?php echo url_for('zapchasti_label_category', array('car_label' => $carLabel, 'category' => $item['slug'])); ?>"><?php echo $item['name'] ?></a>&nbsp;<span class="toggle"><?php echo $matched ? '&raquo;': '&laquo;'; ?></span>
                <?php echo $subList; ?>
                <?php unset($subList); ?>
            </li>
        <?php } ?>
    </ul>
<?php } ?>