<?php
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('admin', 'dev', true);
//sfUser
sfContext::createInstance($configuration);
$user = sfContext::getInstance()->getUser();
if (!$user->isAuthenticated()) {
    header('Location: /');
    die();
}