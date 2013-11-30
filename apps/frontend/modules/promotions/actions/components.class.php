<?php

class promotionsComponents extends sfComponents {

    public function executeSlider() {
        $this->list = AdvertisePeer::retrieveSlides();
    }

}
