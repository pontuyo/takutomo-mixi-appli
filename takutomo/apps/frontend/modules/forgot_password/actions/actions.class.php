<?php

/**
 * forgot_password actions.
 *
 * @package    takutomo
 * @subpackage forgot_password
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class forgot_passwordActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->form = new ForgotPasswordForm();
    if ($request->isMethod('post')){
      $this->form->bind($request->getParameterHolder()->getAll());
      if ($this->form->isValid()){
      	 $b = new sfWebBrowser();
      	 $b->post(sfConfig::get('sf_takutomo_forgot_password_url'),
      	    array('email' => $this->getRequestParameter('email')));
      	 $xml = new SimpleXMLElement($b->getResponseText());
      	 $this->display_description = (string)$xml->status->description;
      	 $this->setTemplate('submit');
      }
    }
  }
}
