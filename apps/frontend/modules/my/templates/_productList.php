<?php
$hasProducts = $sf_data->getRaw('hasProducts');
$products = $sf_data->getRaw('products');
?>
<div class="modal fade" id="Cart" tabindex="-1" role="dialog" aria-labelledby="modalLableCart" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php /* ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo $form->getTitle(); ?></h4>
            </div>
            <?php */ ?>
            <div class="modal-body">
                <h1>Ваша корзина</h1>
                <div class="table-responsive">
                    <?php if ($hasProducts) { ?>
                        <table class="table table-striped">
                            <tr>
                                <th width="18%">Артикул</th>
                                <th width="43%">Наименование</th>
                                <th width="15%">Кол-во</th>
                                <th width="17%">Сумма, руб.</th>
                                <th width="7%">&nbsp;</th>
                            </tr>
                            <?php $summ = 0; ?>
                            <?php foreach ($products as $product) { ?>
                                <tr>
                                    <td><?php echo $product['product']['uid']; ?></td>
                                    <td><a href="<?php echo url_for('zapchasti_label_category_product', array(
                                            'car_label' => $product['label']['slug'],
                                            'category' => $product['category']['slug'],
                                            'product' => $product['product']['slug']
                                        )); ?>"><?php echo $product['product']['name'].' ('.$product['label']['name'].')'; ?></a></td>
                                    <td><?php echo $product['amount']; ?></td>
                                    <td><?php echo sprintf('%.2f', $product['product']['distrib_price']*$product['amount']); ?></td>
                                    <td><a href="#remove" class="btn btn-default btn-sm do-remove">&times;</a></td>
                                </tr>
                                <?php $summ += $product['product']['distrib_price']*$product['amount']; ?>
                            <?php } ?>
                            <?php if ($summ > 0) { ?>
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                    <td>Итого:</td>
                                    <td colspan="2" class="text-right"><?php echo $summ; ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    <?php } else { ?>
                        <p>Ваша конзина пуста</p>
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger">Оформить заказ</a>
                <a class="btn btn-info" data-dismiss="modal" aria-hidden="true">Продолжить покупки</a>
            </div>
        </div>
    </div>
</div>