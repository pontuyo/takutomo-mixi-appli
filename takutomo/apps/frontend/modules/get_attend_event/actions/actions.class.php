<?php
ini_set('include_path', '../../lib/PEAR' . PATH_SEPARATOR . ini_get('include_path'));
require_once 'XML/Unserializer.php';

/**
 * get_attend_event actions.
 *
 * @package    takutomo
 * @subpackage get_attend_event
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class get_attend_eventActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $b = new sfWebBrowser();
    $b->get(sfConfig::get('sf_takutomo_get_attend_event_url'),
      	    array(
      	      'guid' => 'DEBUG,sample_member_001'
      	    )
      	  );
    //xmlを連想配列に変換
    $options = array(
                    'complexType'       => 'array'
                );
         	
    $Unserializer = new XML_Unserializer($options);
    $status = $Unserializer->unserialize($b->getResponseText());
    //if ($status === true) {
    
    $this->get_attend_event_list = $Unserializer->getUnserializedData();
    
  }
}
