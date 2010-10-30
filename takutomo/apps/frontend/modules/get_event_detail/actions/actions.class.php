<?php
ini_set('include_path', '../../lib/PEAR' . PATH_SEPARATOR . ini_get('include_path'));
require_once 'XML/Unserializer.php';

/**
 * get_event_detail actions.
 *
 * @package    takutomo
 * @subpackage get_event_detail
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class get_event_detailActions extends sfActions
{
      //xmlを連想配列に変換
  var $options = array('complexType' => 'array');
  
 /**
  *   * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	
    $this->setMemberData();
    $this->setEventDetail();
    if($request->isMethod('post')){
      $this->addEventComment($request);
    }
  }
  
  
  private function setMemberData()
  {
    $b = new sfWebBrowser();
    $b->post(sfConfig::get('sf_takutomo_get_profile_url'),
      array('id' => $this->getRequestParameter('leader_m_id')));

     $Unserializer = new XML_Unserializer($this->options);
     $status = $Unserializer->unserialize($b->getResponseText());
     $this->member = $Unserializer->getUnserializedData();
  	
  }
  
  private function setEventDetail()
  {
    $b = new sfWebBrowser();
    $b->post(sfConfig::get('sf_takutomo_get_event_detail_url'),
      array('event_id' => $this->getRequestParameter('event_id')));
      	  
     if((int)$xml->status->code >= 1000 ){
       $this->form->getErrorSchema()->addError( 
         new sfValidatorError(new sfValidatorPass(), (string)$xml->status->description)); 
     }else{         	
       $Unserializer = new XML_Unserializer($this->options);
       $status = $Unserializer->unserialize($b->getResponseText());
       $this->event_detail = $Unserializer->getUnserializedData();
     }
  }
  
  private function addEventComment(sfWebRequest $request)
  {
    $b = new sfWebBrowser();
    $this->form = new AddEventCommentForm();
    $this->form->bind($request->getParameterHolder()->getAll());
    if ($this->form->isValid())
    {
      $b = new sfWebBrowser();
      $b->post(sfConfig::get('sf_takutomo_add_event_comment_url'),
      	    array(
      	      'guid' => 'mixi,'.MixiAppMobileApi::$ownerId,
      	      'event_id' => $this->getRequestParameter('event_id'),
      	      'comment' => $this->getRequestParameter('comment')
      	      )
      	  );
      	 $xml = new SimpleXMLElement($b->getResponseText()); 
      	 
         if((int)$xml->status->code >= 1000 ){
           $this->form->getErrorSchema()->addError( 
           new sfValidatorError(new sfValidatorPass(), (string)$xml->status->description)); 
         
         }else{
             $this->display_description = (string)$xml->status->description;
             $this->setTemplate('submit');
         } 
    }  	
  }
}
