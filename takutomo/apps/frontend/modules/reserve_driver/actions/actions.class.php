<?php
ini_set('include_path', '../../lib/PEAR' . PATH_SEPARATOR . ini_get('include_path'));
require_once 'XML/Unserializer.php';

/**
 * reserve_driver actions.
 *
 * @package    takutomo
 * @subpackage reserve_driver
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class reserve_driverActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

    $this->form = new ReserveDriverForm();

    $b = new sfWebBrowser();
    $now = strtotime('+15 minute');
    $depart_date = array('year'=>date('Y',$now),
            'month'=> date('n',$now),
            'day'=>date('j',$now));
    $depart_time = array('hour'=>date('G',$now),
            'minute'=> (int)date('i',$now));
    $b->post(sfConfig::get('sf_takutomo_get_profile_url'),
      	    array('id' => $this->getRequestParameter('driver_id'))
      	  );
     if((int)$xml->status->code >= 1000 ){
           $this->form->getErrorSchema()->addError( 
           new sfValidatorError(new sfValidatorPass(), (string)$xml->status->description)); 
         
     }else{
         //xmlを連想配列に変換
       $options = array(
         'complexType'       => 'array'
       );
         	
       $Unserializer = new XML_Unserializer($options);
       $status = $Unserializer->unserialize($b->getResponseText());
       $this->member = $Unserializer->getUnserializedData();
     }
     
    if ($request->isMethod('get')){
      $mixi = new MixiAppMobileApi;
      $persistence = $mixi->get(sfConfig::get('sf_opensocial_persistence_api'));
      $mixi_persistence = $persistence->entry->{'mixi.jp:'.MixiAppMobileApi::$ownerId};
      
      $this->form->setDefault('to_address',$mixi_persistence->to_address);
      $this->form->setDefault('to_lon',$mixi_persistence->to_lon);
      $this->form->setDefault('to_lat',$mixi_persistence->to_lat);
      $this->form->setDefault('from_address',$mixi_persistence->from_address);
      $this->form->setDefault('from_lon',$mixi_persistence->from_lon);
      $this->form->setDefault('from_lat',$mixi_persistence->from_lat);
      
      $this->form->setDefault('depart_date',$depart_date['year'].
      	                       sprintf('%02d',$depart_date['month']).
      	                       $depart_date['day']); 
      $this->form->setDefault('depart_time',$depart_time['hour']. sprintf('%02d',$depart_time['minute']));
      $this->form->setDefault('driver_m_id',$request->getParameter('driver_id'));
      $this->form->setDefault('phone',$request->getParameter('phone'));
      
      $request->setParameter('from_address',$mixi_persistence->from_address);
      $request->setParameter('to_address',$mixi_persistence->to_address);
      $request->setParameter('depart_date',$depart_date['year'].
      	                       sprintf('%02d',$depart_date['month']).
      	                       $depart_date['day']);
      $request->setParameter('depart_time',$depart_time['hour']. sprintf('%02d',$depart_time['minute']));
      
    }else if ($request->isMethod('post'))
    {
     
       $this->form->bind($request->getParameterHolder()->getAll());
        if ($this->form->isValid())
        {
      	  $b->post(sfConfig::get('sf_takutomo_reserve_driver_url'),
      	    array(
      	      'guid' => 'DEBUG,sample_member_001',
      	      'email' => $this->getUser()->getEmail(),
      	      'password' => $this->getUser()->getPassword(),
      	      'from_address' => $this->getRequestParameter('from_address'),
              'from_lat' => $this->getRequestParameter('from_lat'),
      	      'from_lon' => $this->getRequestParameter('from_lon'),
      	      'to_address' => $this->getRequestParameter('to_address'),
      	      'to_lat' => $this->getRequestParameter('to_lat'),
      	      'to_lon' => $this->getRequestParameter('to_lon'),
      	      'depart_date' => $this->getRequestParameter('depart_date'),
      	      'depart_hour' => substr($this->getRequestParameter('depart_time'),0,2),
      	      'depart_min' => substr($this->getRequestParameter('depart_time'),2,2),
      	      'driver_m_id'=> $request->getParameter('driver_m_id'),
      	      'phone'=> $request->getParameter('phone'),
      	    )
      	  );
      	                    
        $xml = new SimpleXMLElement($b->getResponseText()); 
      	 
      	 //print $b->getResponseText();
         //print((string)$xml->status->code);
         if((int)$xml->status->code >= 1000){
         	$this->form->getErrorSchema()->addError( 
         	new sfValidatorError(new sfValidatorPass(), (string)$xml->status->description)); 
         }else{
         	//検索条件をsessionに格納
         	$this->getUser()->setToAddress($this->getRequestParameter('to_address'));
         	$this->getUser()->setToLon($this->getRequestParameter('to_lon'));
         	$this->getUser()->setToLat($this->getRequestParameter('to_lat'));
         	$this->getUser()->setFromAddress($this->getRequestParameter('from_address'));
         	$this->getUser()->setFromLon($this->getRequestParameter('from_lon'));
         	$this->getUser()->setFromLat($this->getRequestParameter('from_lat'));
            
           $this->setTemplate('submit');
         }
         $this->display_description = (string)$xml->status->description;
         $this->display_phone = (string)$xml->taxi_data->phone;
        }
      }
    }    
  
}
