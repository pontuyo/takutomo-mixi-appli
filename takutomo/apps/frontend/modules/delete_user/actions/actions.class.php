<?php

/**
 * delete_user actions.
 *
 * @package    takutomo
 * @subpackage delete_user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class delete_userActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    if ($request->isMethod('post'))
    {
      
      $b = new sfWebBrowser();

        $b->post(sfConfig::get('sf_takutomo_delete_user_url'),
      	array('guid' => 'DEBUG,sample_member_001',
      	     ));
      	                    
        $xml = new SimpleXMLElement($b->getResponseText()); 
        
        if((int)$xml->status->code >= 1000){
          $this->display_description = (string)$xml->status->description;
         }else{
          $this->display_description = (string)$xml->status->description;
          $this->setTemplate('submit');
        }
      	
      
    }
  }
}
