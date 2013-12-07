<div class="row margin-bottom10 search">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <form role="form" method="post">
            <div class="form-group">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <select name="search[car_label]" class="form-control">
                        <?php foreach (CarLabelPeer::getTopLabelList() as $id => $name) { ?>
                            <option value="<?php echo $id; ?>"<?php echo ($carLabelId == $id) ? ' selected="selected"': ''; ?>><?php echo $name; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <input type="text" name="search[uid]" class="form-control" placeholder="Артикул"/>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <input type="text" name="search[name]" class="form-control" placeholder="Наименование"/>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <input type="submit" name="search[car_label]" class="btn btn-default col-md-offset-6 col-sm-offset-6 col-xs-offset-6 col-md-6 col-sm-6 col-xs-6" value="Поиск"/>
                </div>
            </div>
        </form>
    </div>
</div>