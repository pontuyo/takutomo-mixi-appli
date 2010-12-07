<?php

/**
 * invite actions.
 *
 * @package    takutomo
 * @subpackage invite
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inviteActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$invite_member = $request->getParameter('invite_member');
    if(!empty($invite_member)){
    	$tmp = explode(',',$request->getParameter('invite_member'));
    	$mixi = new MixiAppMobileApi;
    	$list = array();
    	
    	foreach($tmp as $value){
    	  $person = $mixi->get(sfConfig::get('sf_opensocial_friend_search_api').$value);
    	  if(!empty($person))
    	  {
    	  	array_push($list,$person->entry->nickname);
    	  }
    	}
    	$this->list = $list;
    }
  }
}
