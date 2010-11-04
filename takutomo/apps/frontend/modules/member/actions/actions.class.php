<?php
ini_set('include_path', '../../lib/PEAR' . PATH_SEPARATOR . ini_get('include_path'));
require_once 'XML/Unserializer.php';

/**
 * member actions.
 *
 * @package    takutomo
 * @subpackage member
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class memberActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->userAgent = $this->getContext()->getRequest()->getAttribute('userAgent');
    $this->get_attend_event_list = $this->getAttendEventList();
  }
  
  public function executeAinoriHistory(sfWebRequest $request)
  {
  	$this->get_attend_event_list = $this->getAttendEventList();
  	
  }
  
  /**
   * 相乗りリストを返す　
   * errorの場合 null
   */
  private function getAttendEventList()
  {
  	    $b = new sfWebBrowser();
    $b->get(sfConfig::get('sf_takutomo_get_attend_event_url'),
      	    array(
      	      'guid' => 'mixi,'.MixiAppMobileApi::$ownerId
      	    )
      	  );
    //xmlを連想配列に変換
    $options = array(
                    'complexType'       => 'array'
                );
         	
    $Unserializer = new XML_Unserializer($options);
    $status = $Unserializer->unserialize($b->getResponseText());
    if ($status === true) {
      return $Unserializer->getUnserializedData();
    } else {
      return null;
    }
  	
  }
  
}
