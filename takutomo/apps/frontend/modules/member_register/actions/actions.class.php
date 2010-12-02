<?php

/**
 * member_register actions.
 *
 * @package    takutomo
 * @subpackage member_register
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class member_registerActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  var $display_form;
  
  public function executeIndex(sfWebRequest $request)
  {
  	if($this->memberExist())
  	{
  	  $this->setTemplate('exist');
  	  return sfView::SUCCESS;
  	}
  	
  	$this->form = new MemberForm();
  	
  	if ($request->isMethod('get')){
  		$mixi = new MixiAppMobileApi;
  		$person = $mixi->get(sfConfig::get('sf_opensocial_person_api').'?fields=birthday,gender');
  		

  		$this->form->setDefault('name',$person->entry->nickname);
  		$this->form->setDefault('gender',$this->convertGender($person->entry->gender));
  		$this->form->setDefault('age',$this->convertAge($person->entry->birthday));
  	}
  	
  	
  	if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameterHolder()->getAll());
     
      if ($this->getRequestParameter('adjustment') == '' && $this->form->isValid())
      {
      	$this->display_gender = MemberForm::$sexs[$this->getRequestParameter('gender')];

      	//var_dump(MemberForm::$sexs[$this->getRequestParameter('gender')]);
      	//$this->display_form = MemberForm::$sexs[$this->getRequestParameter('gender')];
      	$this->form->freeze();
      	$this->setTemplate('confirm');
      }
    }
    
    return sfView::SUCCESS;
  }

  public function executeConfirm(sfWebRequest $request)
  {
  	$this->display_gender = MemberForm::$sexs[$this->getRequestParameter('gender')];
    
    $b = new sfWebBrowser();
    $b->post(sfConfig::get('sf_takutomo_register_by_guid_url'),
      	array('guid' => 'mixi,'.MixiAppMobileApi::$ownerId,
              'email' => $this->getRequestParameter('email'),
      	      'password' => $this->getRequestParameter('password'),
      	      'name' => $this->getRequestParameter('name'),
      	      'age' => $this->getRequestParameter('age'),
      	      'gender' => $this->display_gender,
      	      'introduction' =>$this->getRequestParameter('introduction')
      	                    ));
    $this->form = new MemberForm();
    //print $b->getResponseText();
     $xml = new SimpleXMLElement($b->getResponseText());
     if((int)$xml->status->code >= 1000 ){
           $this->form->getErrorSchema()->addError( 
           new sfValidatorError(new sfValidatorPass(), (string)$xml->status->description)); 
         
       $this->setTemplate('index');
     }else{
       $this->setTemplate('submit');
     }
     
    $this->display_description = (string)$xml->status->description;

    
    return sfView::SUCCESS;
    
    
  }
  
  /**
   * 会員が存在するかチェック　
   */
  private function memberExist()
  {
  	   $b = new sfWebBrowser();
      	$b->post(sfConfig::get('sf_takutomo_check_registration_url'),
      	array('guid' => 'mixi,'.MixiAppMobileApi::$ownerId //'DEBUG,sample_member_001' 
      	                    ));
 
      	$xml = new SimpleXMLElement($b->getResponseText());       	
      	 
      	 if((int)$xml->status->code >= 1000){
      	   return false;
         }
         
       return true;
  	
  }
  
  /**
   * mixiの性別データを変換
   */  
  private function convertGender($value){
  	if($value == "male"){
  	  return 0;
  	}else{
  	  return 1;
  	}
  }
  /**
   * mixiの誕生日を年齢に変換
   */
  private function convertAge($birth){
    $ty = date("Y");
    $tm = date("m");
    $td = date("d");
    list($by, $bm, $bd) = explode('-', $birth);
    $age = $ty - $by;
    if($tm * 100 + $td < $bm * 100 + $bd) $age--;
    return $age;
  }
  
}
