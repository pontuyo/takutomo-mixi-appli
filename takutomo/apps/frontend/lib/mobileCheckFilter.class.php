<?php
ini_set('include_path', '../../lib/PEAR' . PATH_SEPARATOR . ini_get('include_path'));
require_once('Net/UserAgent/Mobile.php');

/**
 * 携帯の判断をします
 */
class mobileCheckFilter extends sfFilter{
 
 public function execute($filterChain)
 { 
   $response = $this->getContext()->getResponse();
    
    if ($this->isFirstCall())
    {
    	
      $agent = Net_UserAgent_Mobile::singleton();
      $this->getContext()->getRequest()->setAttribute("userAgent", $agent);
      $this->getContext()->getResponse()->setSlot("carrier_css", $agent);

    }
       
    $filterChain->execute(); 
 }
}
?>