<?php

/**
 * add_event_comment actions.
 *
 * @package    takutomo
 * @subpackage add_event_comment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class add_event_commentActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->form = new AddEventCommentForm();
   
    if($request->isMethod('get')){
       $this->form->setDefault('event_id',$request->getParameter('event_id')); 
       	
    }elseif ($request->isMethod('post')){
      $this->form->bind($request->getParameterHolder()->getAll());
      if ($this->form->isValid())
      {
      $b = new sfWebBrowser();
      $b->post(sfConfig::get('sf_takutomo_add_event_comment_url'),
      	    array(
      	      'event_id' => $this->getRequestParameter('event_id'),
      	      'comment' => $this->getRequestParameter('comment')
      	      )
      	  );
      	  
        print $b->getResponseText();
      }
    }
      
  }
     
}
