<?php

class formsComponents extends sfComponents {

    public function executeForm() {
        // $this->formname
        $this->form = ServiceFormPeer::retrieveByName($this->name);
        if (!($this->form instanceof ServiceForm)) exit;
    }
}
