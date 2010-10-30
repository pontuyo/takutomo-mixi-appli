<?php


/**
 * mixiログインの判断をします
 */
class MixiMobileLoginCheckFilter extends sfFilter{
 
 public function execute($filterChain)
 { 
   $response = $this->getContext()->getResponse();
    
    if ($this->isFirstCall())
    {
      MixiAppMobileApi::initWithConsumer(
	    '72c8baa2729242c60971',//key
	    '34567026c9d9b70550be5aa4b3648b21765bc6f9'//secret
      );
     
        $b = new sfWebBrowser();
      	$b->post(sfConfig::get('sf_takutomo_get_profile_myself_url'),
      	array('guid' => 'mixi,'.MixiAppMobileApi::$ownerId //'DEBUG,sample_member_001' 
      	                    ));
 
      	$xml = new SimpleXMLElement($b->getResponseText()); 
      	$moduleArr = array('index','member_register','forgot_password');
      	
      	 
      	 if((int)$xml->status->code >= 1000){
      	   
      	   if(array_search(sfContext::getInstance()->getModuleName(),$moduleArr) === false){
             header("Location:".sfConfig::get('sf_mixi_index_url'));
             exit;
           }
           
         }else{
         
         	$this->getContext()->getUser()->setName((string)$xml->profile->name);
         	$this->getContext()->getUser()->setEmail((string)$xml->profile->email);
         	$this->getContext()->getUser()->setPassword((string)$xml->profile->password);
         	$this->getContext()->getUser()->setAuthenticated(true);
         	
         }

    }
       
    $filterChain->execute(); 
 }
}
?>