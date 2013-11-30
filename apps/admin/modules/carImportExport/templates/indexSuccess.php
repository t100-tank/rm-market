<?php use_helper('I18N', 'Date') ?>

<div id="sf_admin_container">
    <h1><?php echo __('Импорт/Экспорт', array(), 'messages') ?></h1>

    <?php include_partial('carImportExport/flashes') ?>

    <div id="sf_admin_content">
        <form>
            <div class="sf_admin_list"></div>
            <ul class="sf_admin_actions">
                <li class="sf_admin_action_import_original_parts"><a href="<?php echo url_for('@car_import_original_parts_form'); ?>">Импорт оригинальных запчастей</a></li>
            </ul>
        </form>
    </div>

    <div id="sf_admin_footer">
    </div>
</div>
