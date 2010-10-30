<?php
ini_set('include_path', '../../lib/PEAR' . PATH_SEPARATOR . ini_get('include_path'));
require_once 'XML/Unserializer.php';

/**
 * edit_email actions.
 *
 * @package    takutomo
 * @subpackage edit_email
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class edit_emailActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->getProFileMySelf();
  }
  
  public function executeConfirm(sfWebRequest $request)
  {
    $this->form = new EditEmailForm();
  	
  	if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameterHolder()->getAll());
     $b = new sfWebBrowser();
      if ($this->form->isValid())
      {
        $b->post(sfConfig::get('sf_takutomo_edit_email_url'),
      	array('guid' => 'mixi,'.MixiAppMobileApi::$ownerId,
      	      'new_email' => $this->getRequestParameter('new_email'),
      	      'new_password' => $this->getRequestParameter('new_password'),
      	     ));
      	                    
        $xml = new SimpleXMLElement($b->getResponseText()); 
        
        if((int)$xml->status->code >= 1000){
        	
         	$this->form->getErrorSchema()->addError( 
         	new sfValidatorError(new sfValidatorPass(), (string)$xml->status->description)); 
         }else{
          $this->display_description = (string)$xml->status->description;
          $this->setTemplate('submit');
        }
      	
      }
    }
    
  }
    
  private function getProFileMySelf()
  {
    $b = new sfWebBrowser();
    $b->post(sfConfig::get('sf_takutomo_get_profile_myself_url'),
      array('guid' => 'mixi,'.MixiAppMobileApi::$ownerId));
      	                    
    $xml = new SimpleXMLElement($b->getResponseText()); 
    $this->profileForm = new sfForm();
    if((int)$xml->status->code >= 1000){
         	$this->profileForm->getErrorSchema()->addError( 
         	new sfValidatorError(new sfValidatorPass(), (string)$xml->status->description)); 
    }else{
          $options = array(
         'complexType'       => 'array'
         );
         	
         $Unserializer = new XML_Unserializer($options);
         $status = $Unserializer->unserialize($b->getResponseText());
         $this->profile = $Unserializer->getUnserializedData();
      }
  }
}
