<?php
ini_set('include_path', '../../lib/PEAR' . PATH_SEPARATOR . ini_get('include_path'));
require_once 'XML/Unserializer.php';

/**
 * eval_user actions.
 *
 * @package    takutomo
 * @subpackage eval_user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eval_userActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $this->form = new sfForm();	
      //xmlを連想配列に変換
      $options = array(
         'complexType'       => 'array'
      );
     $b = new sfWebBrowser();
     $b->post(sfConfig::get('sf_takutomo_get_profile_url'),
      	  array('id' => $this->getRequestParameter('m_id'))
      	  );
     $Unserializer = new XML_Unserializer($options);
     $status = $Unserializer->unserialize($b->getResponseText());
     $this->profile = $Unserializer->getUnserializedData();

  }
  
  public function executeSubmit(sfWebRequest $request)
  {
  	$requestIdKey = null;
  	$requestIdValue = null;
  	if($this->getRequestParameter('request_id') != ""){
  		$requestIdKey = 'request_id';
  		$requestIdValue = $this->getRequestParameter('request_id');
  	}else if($this->getRequestParameter('event_id') != ""){
  		$requestIdKey = 'event_id';
  		$requestIdValue = $this->getRequestParameter('event_id');
  	}
  	
  	$b = new sfWebBrowser();
    $b->post(sfConfig::get('sf_takutomo_eval_user_url'),
      array('guid' => 'mixi,'.MixiAppMobileApi::$ownerId,
            //'email' => 'pontuyo.net@docomo.ne.jp',
            //'password' => 'pontuyo',
            'id' => $this->getRequestParameter('id'),
            'eval' => $this->getRequestParameter('eval'),
            'eval_comment' => $this->getRequestParameter('eval_comment'),
            $requestIdKey => $requestIdValue
      	    ));
      	    
      $this->form = new sfForm();	    
      $xml = new SimpleXMLElement($b->getResponseText()); 
      if((int)$xml->status->code >= 1000 ){
           $this->form->getErrorSchema()->addError( 
           new sfValidatorError(new sfValidatorPass(), (string)$xml->status->description));
           $this->setTemplate('index'); 
      }
      $this->display_description = (string)$xml->status->description;
      
  }
}
