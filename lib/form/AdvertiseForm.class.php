<?php

/**
 * Advertise form.
 *
 * @package    rm-market
 * @subpackage form
 * @author     Arij
 */
class AdvertiseForm extends BaseAdvertiseForm {

    public function configure() {
        $this->widgetSchema['slider_image'] = new sfWidgetFormInputFile();
        $this->validatorSchema['slider_image'] = new sfValidatorFile(array(
            'required'   => true,
            'path'       => sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.sfConfig::get('app_adv_dir'),
            'mime_types' => 'web_images',
            'validated_file_class' => 'PictureFileHandler'
          ));
        
        $this->widgetSchema['short_text'] = new sfWidgetFormTextareaTinyMCE();
        $this->widgetSchema['description'] = new sfWidgetFormTextareaTinyMCE();
        
        if (!$this->getObject()->isNew()) {
            $this->validatorSchema['slider_image']->setOption('required', false);
        }
    }

}
