<?php $img = $Advertise->getSliderImage(); ?>
<?php if (!empty($img)) { ?>
    <img src="<?php echo $Advertise->getHtmlImagePath(); ?>"/>
<?php } else { ?>
    &nbsp;
<?php } ?>
