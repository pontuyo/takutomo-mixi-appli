<?php


require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

define('SF_ROOT_DIR', realpath(dirname(__FILE__).'/..'));
define('SF_APP',         'frontend'); 
define('SF_ENVIRONMENT', 'prod'); 
define('SF_DEBUG',       false);


$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'prod', true);
sfContext::createInstance($configuration)->dispatch();
