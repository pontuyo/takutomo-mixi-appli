<?php
ini_set('include_path', '../../lib/PEAR' . PATH_SEPARATOR . ini_get('include_path'));
require_once 'XML/Unserializer.php';

/**
 * get_profile actions.
 *
 * @package    takutomo
 * @subpackage get_profile
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class get_profileActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $b = new sfWebBrowser();
    $b->post(sfConfig::get('sf_takutomo_get_profile_url'),
      	    array(
      	      'id' => $this->getRequestParameter('id')
      	      )
      	  );
     if((int)$xml->status->code >= 1000 ){
           $this->form->getErrorSchema()->addError( 
           new sfValidatorError(new sfValidatorPass(), (string)$xml->status->description)); 
         
     }else{
         //xmlを連想配列に変換
       $options = array(
         'complexType'       => 'array'
       );
         	
       $Unserializer = new XML_Unserializer($options);
       $status = $Unserializer->unserialize($b->getResponseText());
       $this->member = $Unserializer->getUnserializedData();
     }
 
  }
}
