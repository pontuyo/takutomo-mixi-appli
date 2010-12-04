<?php


/**
 * mixiログインの判断をします
 */
class MixiMobileLoginCheckFilter extends sfFilter{
 
 public function execute($filterChain)
 { 
   $response = $this->getContext()->getResponse();
    
    if ($this->isFirstCall() && 
    strcmp($this->getContext()->getModuleName(),sfConfig::get('sf_error_404_module')) != 0 )
    //if ($this->isFirstCall())
    {
      MixiAppMobileApi::initWithConsumer(
	    '72c8baa2729242c60971',//key
	    '34567026c9d9b70550be5aa4b3648b21765bc6f9'//secret
      );
     
       if(!$this->memberExist())
       {
         if(!$this->memberRegister())
         {
           header("Location:".sfConfig::get('sf_mixi_index_url') ."error/");
           exit;
           //return $this->getContext()->getController()->forward('error', 'index');
         }
       }

    }
       
    $filterChain->execute(); 
 }
 /**
  * 
  */
 
   /**
   * 会員が存在するかチェック
   * return boolean 存在する true 存在しない false
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
  * タクトモ会員登録
  * return boolean
  */
 private function memberRegister()
 {
    $mixi = new MixiAppMobileApi;
  	$person = $mixi->get(sfConfig::get('sf_opensocial_person_api').'?fields=birthday,gender');
    
    $b = new sfWebBrowser();
    $b->post(sfConfig::get('sf_takutomo_register_by_guid_url'),
      	array('guid' => 'mixi,'.MixiAppMobileApi::$ownerId,
      	      'name' => $person->entry->nickname,
      	      'age' => $this->convertAge($person->entry->birthday),
      	      'gender' => $this->convertGender($person->entry->gender),
      	      'introduction' =>''
      	                    ));
      	                    
    $xml = new SimpleXMLElement($b->getResponseText()); 
    $moduleArr = array('index','member_register','forgot_password');
      	 
    if((int)$xml->status->code >= 1000){
      	   
      /*if(array_search(sfContext::getInstance()->getModuleName(),$moduleArr) === false){
           header("Location:".sfConfig::get('sf_mixi_index_url'));
           exit;
      }*/
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
?>