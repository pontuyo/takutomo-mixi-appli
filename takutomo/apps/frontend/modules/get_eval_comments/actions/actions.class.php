<?php
ini_set('include_path', '../../lib/PEAR' . PATH_SEPARATOR . ini_get('include_path'));
require_once 'XML/Unserializer.php';

/**
 * get_eval_comments actions.
 *
 * @package    takutomo
 * @subpackage get_eval_comments
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class get_eval_commentsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //xmlを連想配列に変換
    $options = array(
      'complexType'   => 'array'
    );
    $Unserializer = new XML_Unserializer($options);

    $b = new sfWebBrowser();
        $b->post(sfConfig::get('sf_takutomo_get_profile_url'),
      	    array(
      	      'id' => $this->getRequestParameter('id')
      	      )
      	  );
     if((int)$xml->status->code >= 1000 ){
           $this->form->getErrorSchema()->addError( 
           new sfValidatorError(new sfValidatorPass(), (string)$xml->status->description)); 
         
     }else{
       $status = $Unserializer->unserialize($b->getResponseText());
       $this->member = $Unserializer->getUnserializedData();
     }
     
    $b->post(sfConfig::get('sf_takutomo_get_eval_comments_url'),
      	    array(
      	      'id' => $this->getRequestParameter('m_id')
      	      )
      	  );
     if((int)$xml->status->code >= 1000 ){
           $this->form->getErrorSchema()->addError( 
           new sfValidatorError(new sfValidatorPass(), (string)$xml->status->description)); 
         
     }else{
         	
       $status = $Unserializer->unserialize($b->getResponseText());
       $this->comments = $Unserializer->getUnserializedData();
     }
  }
}
