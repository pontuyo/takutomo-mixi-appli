<?php

/**
 * login actions.
 *
 * @package    takutomo
 * @subpackage login
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class loginActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
   	$this->form = new LoginForm();
  	
  	if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameterHolder()->getAll());
     
      if ($this->form->isValid())
      {
      	
      	$b = new sfWebBrowser();
      	
      	$b->post('http://api.takutomo.com/v3/member/get_profile_myself.php?api_key=pontuyo',
      	array('email' => $this->getRequestParameter('email'),
      	      'password' => $this->getRequestParameter('password')
      	                    ));
      	                    
        print $b->getResponseText();
        $xml = new SimpleXMLElement($b->getResponseText()); 
      	//var_dump(MemberForm::$sexs[$this->getRequestParameter('gender')]);
      	//$this->display_form = MemberForm::$sexs[$this->getRequestParameter('gender')];
      	//$this->form->freeze();
      //	$this->setTemplate('confirm');
      }
    }
  }
}
