<?php
ini_set('include_path', '../../lib/PEAR' . PATH_SEPARATOR . ini_get('include_path'));
require_once 'XML/Unserializer.php';

/**
 * eval_driver actions.
 *
 * @package    takutomo
 * @subpackage eval_driver
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eval_driverActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    
    $b = new sfWebBrowser();
    $b->post(sfConfig::get('sf_takutomo_get_reserved_driver_url'),
      array('guid' => 'mixi,'.MixiAppMobileApi::$ownerId));
      
    $options = array(
        'complexType'       => 'array',
        'parseAttributes' => TRUE
    );
    $Unserializer = new XML_Unserializer($options);
    //$Unserializer->setOption('parseAttributes', TRUE); 
    $status = $Unserializer->unserialize($b->getResponseText());
    $this->list = $Unserializer->getUnserializedData();
  }
}
