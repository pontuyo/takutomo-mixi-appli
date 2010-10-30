<?php
ini_set('include_path', '../../lib/PEAR' . PATH_SEPARATOR . ini_get('include_path'));
require_once 'XML/Unserializer.php';

/**
 * edit_profile actions.
 *
 * @package    takutomo
 * @subpackage edit_profile
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class edit_profileActions extends sfActions
{
  var $options = array('complexType'  => 'array');
  
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->form = new ProfileForm();
    $this->getProFileMySelf();
    $this->getProfile($this->profileMySelf['profile']['m_id']);
    if($request->isMethod('get')){
    	foreach($this->profile as $value){
    	 
    	  if($value['m_id'])
    	  {
	    	$this->form->setDefault('name',$value['name']);
	    	$this->form->setDefault('age',str_replace("代", "", $value['age']));
	    	$this->form->setDefault('gender',$this->convertGender($value['gender']));
	    	$this->form->setDefault('introduction',$value['introduction']);
	    	$this->form->setDefault('from1',$value['from1']);
	    	$this->form->setDefault('from2',$value['from2']);
	    	$this->form->setDefault('from3',$value['from3']);
	    	$this->form->setDefault('from4',$value['from4']);
	    	$this->form->setDefault('from5',$value['from5']);
	    	$this->form->setDefault('to1',$value['to1']);
	    	$this->form->setDefault('to2',$value['to2']);
	    	$this->form->setDefault('to3',$value['to3']);
	    	$this->form->setDefault('to4',$value['to4']);
	    	$this->form->setDefault('to5',$value['to5']);
    	  	
    	  }
    	}
    	
    }
    
    if($request->isMethod('post'))
    {
      $this->form->bind($request->getParameterHolder()->getAll());
      if($this->form->isValid()){
        $this->updateProfile($request);
      }
      
      if($this->form->isValid()){
        $this->setTemplate('submit');
      }
    }
  }
  
  private function updateProfile(sfWebRequest $request)
  {
    $gender = ProfileForm::$sexs[$this->getRequestParameter('gender')];
    $this->takutomoEditProfile('name',$request->getParameter('name'));
  	$this->takutomoEditProfile('age',$request->getParameter('age'));
  	$this->takutomoEditProfile('gender',$gender);
  	$this->takutomoEditProfile('introduction',$request->getParameter('introduction'));
  	$this->takutomoEditProfile('from1',$request->getParameter('from1'));
  	$this->takutomoEditProfile('from2',$request->getParameter('from2'));
  	$this->takutomoEditProfile('from3',$request->getParameter('from3'));
  	$this->takutomoEditProfile('from4',$request->getParameter('from4'));
  	$this->takutomoEditProfile('from5',$request->getParameter('from5'));
  	$this->takutomoEditProfile('to1',$request->getParameter('to1'));
  	$this->takutomoEditProfile('to2',$request->getParameter('to2'));
  	$this->takutomoEditProfile('to3',$request->getParameter('to3'));
  	$this->takutomoEditProfile('to4',$request->getParameter('to4'));
  	$this->takutomoEditProfile('to5',$request->getParameter('to5'));

  }
  
  private function takutomoEditProfile($item,$value)
  {
  	$b = new sfWebBrowser();
    $b->post(sfConfig::get('sf_takutomo_edit_profile_url'),
      array('guid' => 'mixi,'.MixiAppMobileApi::$ownerId,
            'item' => $item,
            'value' => $value));
            
     $xml = new SimpleXMLElement($b->getResponseText()); 
     if((int)$xml->status->code >= 1000 ){
           $this->form->getErrorSchema()->addError( 
           new sfValidatorError(new sfValidatorPass(), (string)$xml->status->description)); 
         
     }
  }
  
  private function getProFileMySelf()
  {
    $b = new sfWebBrowser();
    $b->post(sfConfig::get('sf_takutomo_get_profile_myself_url'),
      array('guid' => 'mixi,'.MixiAppMobileApi::$ownerId));
      	                    
    $xml = new SimpleXMLElement($b->getResponseText()); 
    $this->profileMySelfForm = new sfForm();
    if((int)$xml->status->code >= 1000){
         	$this->profileMySelfForm->getErrorSchema()->addError( 
         	new sfValidatorError(new sfValidatorPass(), (string)$xml->status->description)); 
    }else{
         	
         $Unserializer = new XML_Unserializer($this->options);
         $status = $Unserializer->unserialize($b->getResponseText());
         $this->profileMySelf = $Unserializer->getUnserializedData();
      }
  }
  
  private function getProfile($id)
  {
  	$b = new sfWebBrowser();
    $b->post(sfConfig::get('sf_takutomo_get_profile_url'),
      	    array(
      	      'id' => $id
      	      )
      	  );
    $this->profileForm = new sfForm();
    $xml = new SimpleXMLElement($b->getResponseText()); 
     if((int)$xml->status->code >= 1000 ){
           $this->profileForm->getErrorSchema()->addError( 
           new sfValidatorError(new sfValidatorPass(), (string)$xml->status->description)); 
         
     }else{
         	
       $Unserializer = new XML_Unserializer($this->options);
       $status = $Unserializer->unserialize($b->getResponseText());
       $this->profile = $Unserializer->getUnserializedData();
     }
  }
  
  private function convertGender($value)
  {
  	if($value == "男"){
  	  return 0;
  	}else{
  	 return 1;
  	}
  }
}
