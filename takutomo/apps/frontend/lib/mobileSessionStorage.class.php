<?php
/*
 * Created on 2010/04/14
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
ini_set('include_path', '../../lib/PEAR' . PATH_SEPARATOR . ini_get('include_path'));
require_once('Net/UserAgent/Mobile.php');

class mobileSessionStorage extends sfSessionStorage{
  public function initialize($context, $parameters = null){
    parent::initialize($context, $parameters); 
    // UserAgent取得
    $agent = new Net_UserAgent_Mobile();
    //$agent = $this->getContext()->getRequest()->getAttribute('userAgent');
    if ($agent->isDoCoMo()) {
      ini_set("session.use_trans_sid", 1);
      ini_set("session.use_cookies", 0);
    } else if ($agent->isSoftBank()) {
      ini_set("session.use_trans_sid", 0);
      ini_set("session.use_cookies", 1);
    } else if ($agent->isEZweb()) { 
      ini_set("session.use_trans_sid", 0);
      ini_set("session.use_cookies", 1);
	}
      
    
  }
}
?>
