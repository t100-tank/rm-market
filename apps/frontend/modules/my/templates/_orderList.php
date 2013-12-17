<div class="table-responsive">
    <?php if ($hasProducts) { ?>
        <table class="table">
            <?php $summ = 0; ?>
            <?php foreach ($products as $index => $product) { ?>
                <tr>
                    <td width="60%"><a href="<?php echo url_for('zapchasti_label_category_product', array(
                            'car_label' => $product['label']['slug'],
                            'category' => $product['category']['slug'],
                            'product' => $product['product']['slug']
                        )); ?>" title="<?php echo $product['product']['uid']; ?>"><?php echo $product['product']['name'].' ('.$product['label']['name'].')'; ?></a></td>
                    <td width="16%"><?php echo sprintf('%.2f', $product['product']['distrib_price']); ?>&nbsp;руб.</td>
                    <td width="8%">x<?php echo $product['amount']; ?></td>
                    <td width="16%"><?php echo sprintf('%.2f', $product['product']['distrib_price']*$product['amount']); ?>&nbsp;руб.</td>
                </tr>
                <?php $summ += $product['product']['distrib_price']*$product['amount']; ?>
            <?php } ?>
            <?php if ($summ > 0) { ?>
                <tr>
                    <td><a data-toggle="modal" href="<?php echo url_for('my_cart'); ?>" class="btn btn-info">Редактировать заказ</a></td>
                    <td>Итого:</td>
                    <td colspan="2" class="text-right"><?php echo $summ; ?>р.</td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>Ваша конзина пуста</p>
    <?php } ?>
</div>