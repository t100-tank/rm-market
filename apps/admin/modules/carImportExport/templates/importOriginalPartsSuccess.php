<div class="content">
    <form action="<?php echo url_for('@car_import_original_parts'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
        <div class="form-group">
            <label for="csv" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">CSV</label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <input type="file" class="form-control" id="csv" name="csv"/>
            </div>
        </div>
        <div class="form-group">
            <label for="encoding" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Кодировка</label>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <select class="form-control" id="encoding" name="encoding">
                    <option value="UTF-8">UTF-8</option>
                    <option value="CP1251" selected="selected">CP1251</option>
                    <option value="KOI8-R">KOI8-R</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <button type="submit" class="btn btn-sm btn-default">Отправить</button>
            </div>
        </div>
    </form>
</div>