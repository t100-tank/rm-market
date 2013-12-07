<?php $search = $sf_user->getAttribute('search', array()); ?>
<div class="row margin-bottom10 search">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <form action="<?php echo url_for('zapchasti_label_search', array('car_label' => $carLabelSlug)) ?>" role="form" method="post">
            <?php $rand = rand(0,2); ?>
            <?php $sf_user->setAttribute('search_key', md5(time().rand(1000,9999))); ?>
            <input type="hidden" name="search[check]" value="<?php echo $sf_user->getAttribute('search_key'); ?>"/>
            <div class="form-group">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <select name="search[car_label]" class="form-control">
                        <?php foreach (CarLabelPeer::getTopLabelList() as $slug => $name) { ?>
                            <option value="<?php echo $slug; ?>"<?php echo ($carLabelSlug == $slug) ? ' selected="selected"': ''; ?>><?php echo $name; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <input type="text" name="search[uid]" class="form-control" placeholder="Артикул"<?php echo isset($search['uid']) ? ' value="'.$search['uid'].'"': ''; ?>/>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <input type="text" name="search[name]" class="form-control" placeholder="Наименование"<?php echo isset($search['name']) ? ' value="'.$search['name'].'"': ''; ?>/>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <input type="submit" name="search[submit]" class="btn btn-default col-md-offset-6 col-sm-offset-6 col-xs-offset-6 col-md-6 col-sm-6 col-xs-6" value="Поиск"/>
                </div>
            </div>
        </form>
    </div>
</div>