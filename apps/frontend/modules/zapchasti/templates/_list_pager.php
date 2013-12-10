<?php
/** Incoming params:
 * @param $pager (sfPropelPager) set of Product instances
 * @param $carLabel (CarLabel)
 * @param $routePrefix (string)
 */
$routePrefix = $sf_data->getRaw('routePrefix');
?>
<?php if ($pager->count()) { ?>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr class="active">
                <th width="20%">Артикул</th>
                <th width="45%">Наименование</th>
                <th width="12%">Цена, руб.</th>
                <th width="12%">Кол-во</th>
                <th width="11%">&nbsp;</th>
            </tr>
            <?php foreach ($pager->getResults() as $p) { ?>
                <tr class="item-holder">
                    <td><?php echo $p->getUid(); ?></td>
                    <td><a href="<?php echo url_for('zapchasti_label_category_product', array(
                            'car_label' => $carLabel->getSlug(),
                            'category' => $p->getCategory()->getSlug(),
                            'product' => $p->getSlug()
                        )); ?>"><?php echo $p->getName(); ?></a></td>
                    <td><?php echo sprintf('%.2f', $p->getDistribPrice()); ?></td>
                    <td><input type="text" name="amount" class="form-control" placeholder="1"></td>
                    <td><a href="<?php echo url_for('zapchasti_add_to_cart', array(
                            'car_label' => $carLabel->getSlug(),
                            'product' => $p->getSlug()
                        )); ?>" class="to-cart" title="Добавить в корзину">В корзину</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php if ($pager->haveToPaginate()) { ?>
        <ul class="pagination pagination-sm">
            <li><a href="<?php echo url_for($routePrefix.'&page=1'); ?>">&laquo;</a>
            <?php /* ?><li><a href="<?php echo url_for($routePrefix.'&page='.$pager->getPreviousPage()); ?>">&lt;</a></li><?php */ ?>
            <?php foreach ($pager->getLinks() as $page): ?>
                <?php if ($page == $pager->getPage()): ?>
                    <li class="active"><a href="#"><?php echo $page ?></a></li>
                <?php else: ?>
                    <li><a href="<?php echo url_for($routePrefix.'&page='.$page); ?>"><?php echo $page ?></a></li>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php /* ?><li><a href="<?php echo url_for($routePrefix.'&page='.$pager->getNextPage()); ?>">&gt;</a></li><?php */ ?>
            <li><a href="<?php echo url_for($routePrefix.'&page='.$pager->getLastPage()); ?>">&raquo;</a></li>
        </ul>
    <?php } ?>
<?php } else { ?>
    <p>Список товара отсутствует</p>
<?php } ?>