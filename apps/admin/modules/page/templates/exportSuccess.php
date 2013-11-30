<div class="content">
    <div class="row">
        <ul>
            <li><?php echo link_to('utf-8', '@pages_export_enc?encoding=UTF-8', array('class'=> 'dialog-close')); ?></li>
            <li><?php echo link_to('windows 1251', '@pages_export_enc?encoding=CP1251', array('class'=> 'dialog-close')); ?></li>
            <li><?php echo link_to('koi8-r', '@pages_export_enc?encoding=KOI8-R', array('class'=> 'dialog-close')); ?></li>
        </ul>
    </div>
</div>