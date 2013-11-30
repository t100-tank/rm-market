<?php

class myUser extends sfGuardSecurityUser
{
    public function signIn($user, $remember = false, $con = null) {
        parent::signIn($user, $remember, $con);
        if (is_object($this->getGuardUser())) {
            $this->setCulture(sfConfig::get('sf_default_culture'));
        }
    }
}
