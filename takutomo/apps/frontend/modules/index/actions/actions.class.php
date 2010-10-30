<?php
ini_set('include_path', '../../lib/PEAR' . PATH_SEPARATOR . ini_get('include_path'));
require 'OAuth.php';

/**
 * index actions.
 *
 * @package    takutomo
 * @subpackage index
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class indexActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->form = new LoginForm();
  	$agent = $this->getContext()->getRequest()->getAttribute('userAgent');
  	//print($agent->isDoCoMo());
  	// APIのURLなどの詳細は以下を参照。
// http://developer.mixi.co.jp/appli/appli_mobile/lets_enjoy_making_mixiappmobile/for_partners

$personApi		= 'http://api.mixi-platform.com/os/0.8/people/@me/@self';
$persistenceApi	= 'http://****************************************';



$mixi = new MixiAppMobileApi;

// owner(viewer) データ取得
//print_r($mixi->get($personApi));
$person = $mixi->get($personApi);


  	if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameterHolder()->getAll());
     
      if ($this->getRequestParameter('login') != '' && $this->form->isValid())
      {
      	$b = new sfWebBrowser();
      	$b->post(sfConfig::get('sf_takutomo_get_profile_myself_url'),
      	array('guid' => 'DEBUG,sample_member_001',
              'email' => $this->getRequestParameter('email'),
      	      'password' => $this->getRequestParameter('password')
      	                    ));
      	                    

        $xml = new SimpleXMLElement($b->getResponseText()); 
         
         if((int)$xml->status->code >= 1000){
         	$this->form->getErrorSchema()->addError( 
         	new sfValidatorError(new sfValidatorPass(), (string)$xml->status->description)); 

         }else{
         	$this->getUser()->setName((string)$xml->profile->name);
         	$this->getUser()->setEmail((string)$xml->profile->email);
         	$this->getUser()->setPassword((string)$xml->profile->password);
         	$this->getUser()->setAuthenticated(true);
         	//$this->redirect("member", "index");
         	//print('index');
         	$this->forward('member','index');
         	$this->redirect('http://pontuyo.net/takutomo/web/member');
         	if($agent->isDoCoMo()){
         	  $this->redirect('member/index?sid='+SID);
         	}else{
         	  $this->redirect('member/index');
         	}
         	
         }
         $this->display_description = (string)$xml->status->description;
         //$this->display_response = (string)$b->getResponseText();

      }
    }
  }
}
