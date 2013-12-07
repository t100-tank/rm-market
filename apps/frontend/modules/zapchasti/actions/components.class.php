<?php

class zapchastiComponents extends sfComponents {

    /** generating tree of the categories
     * @param $carLabel
     * @param $carLabelId
     */
    public function executeTree() {
        $cache = new sfFileCache(array('cache_dir' => sfConfig::get('sf_cache_dir').DIRECTORY_SEPARATOR.sfConfig::get('app_category_cache_dir')));
        $this->tree = $cache->get($this->carLabel);
        if (is_null($this->tree) || !($this->tree = json_decode($this->tree, true))) {
            // generate $tree
            $this->tree = CarCategoryPeer::getStructuredLabelCategories($this->carLabelId);
            // store tree
            $cache->set($this->carLabel, json_encode($this->tree), sfConfig::get('app_category_cache_ttl'));

            /** clean-up in categories generation
             * $cache->removePattern($car_label);
             * $cache->remove($car_label);
             */
        }
    }

}
