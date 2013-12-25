<?php
ini_set('max_execution_time', 180);
//ini_set('memory_limit', '1024M');
require_once dirname(__FILE__) . '/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration {

    public function setup() {
        $this->enablePlugins('sfPropelPlugin');
        $this->enablePlugins('sfGuardPlugin');
        $this->enablePlugins('sfFormExtraPlugin');
        $this->enablePlugins('sfImageTransformPlugin');
//        if (isset($_SERVER['DOCUMENT_ROOT']))
//            $this->setWebDir($_SERVER['DOCUMENT_ROOT']);
    }

}
