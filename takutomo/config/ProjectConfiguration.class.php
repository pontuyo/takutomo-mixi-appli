<?php
require_once '../../lib/symfony-1.4.1/lib/autoload/sfCoreAutoload.class.php';

#require_once '/Users/pontuyo/Sites/symfony-1.4.1/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');
    $this->enablePlugins('sfWebBrowserPlugin');
    $this->enablePlugins('sfMobileCarrierJPPlugin');
    $this->enablePlugins('sfJpMobilePlugin');
  }
}
