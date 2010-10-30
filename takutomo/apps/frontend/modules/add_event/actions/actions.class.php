<?php

/**
 * add_event actions.
 *
 * @package    takutomo
 * @subpackage add_event
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class add_eventActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->form = new AddEventForm();
    $b = new sfWebBrowser();
    $now = strtotime('+15 minute');
    $depart_date = array('year'=>date('Y',$now),
            'month'=> date('n',$now),
            'day'=>date('j',$now));
    $depart_time = array('hour'=>date('G',$now),
            'minute'=> (int)date('i',$now));
            
    if ($request->isMethod('get')){
      $request->setParameter('lat',str_replace('+','',$this->getRequestParameter('lat')));
      $request->setParameter('lon',str_replace('+','',$this->getRequestParameter('lon')));
      $b->get(sfConfig::get('sf_google_geo_url'),
      	    array('output' => 'xml',
      	      'hl' => 'ja',
      	      'key' => sfConfig::get('sf_google_key'),
      	      'oe' => 'UTF-8',
      	      'll' => $this->getRequestParameter('lat') .','.
                      $this->getRequestParameter('lon'),
      	    )
      	);
      $xml = new SimpleXMLElement($b->getResponseText()); 
      $from_address = (string)$xml->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->AdministrativeAreaName;
      $from_address .= (string)$xml->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->Locality->LocalityName;
      $from_address .= (string)$xml->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->Locality->DependentLocality->DependentLocalityName;
      $from_address .= (string)$xml->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->Locality->DependentLocality->Thoroughfare->ThoroughfareName;
      
      //初期値設定
      $this->form->setDefault('from_address',$from_address); 
      $this->form->setDefault('from_lat',$this->getRequestParameter('lat')); 
      $this->form->setDefault('from_lon',$this->getRequestParameter('lon'));

      $this->form->setDefault('depart_date',$depart_date); 
      $this->form->setDefault('depart_time',$depart_time);
      
   

    }else if ($request->isMethod('post'))
    {
      //出発地
      if($request->getParameter('departure') != ''){

        $b->get(sfConfig::get('sf_google_geo_url'),
      	    array('output' => 'xml',
      	      'sensor' => 'false',
      	      'key' => sfConfig::get('sf_google_key'),
      	      'q' => $request->getParameter('from_address')
      	    )
      	);        
        //print (string)$b->getResponseText();
        //print "<br>";
        $xml = new SimpleXMLElement($b->getResponseText());
        if(count($xml->Response->Placemark) > 1){
        	$this->form->getErrorSchema()->addError( 
         	  new sfValidatorError(new sfValidatorPass(), '出発地が複数あります、詳しく入力してください。',array('from_address'))
         	);
        }else{
        	
        }
       
        
        $split = explode(',',(string)$xml->Response->Placemark[0]->Point->coordinates);
        $this->form->setDefault('from_address',$request->getParameter('from_address')); 
        $this->form->setDefault('from_lat',$split[1]);
        $this->form->setDefault('from_lon',$split[0]); 
        $this->form->setDefault('to_address',$request->getParameter('to_address')); 
        $this->form->setDefault('to_lat',$request->getParameter('to_lat'));
        $this->form->setDefault('to_lon',$request->getParameter('to_lon'));
        $this->form->setDefault('depart_date',$depart_date); 
        $this->form->setDefault('depart_time',$depart_time);

      //目的地
      }else if($request->getParameter('destination') != ''){
      
      	$b->get(sfConfig::get('sf_google_geo_url'),
      	    array('output' => 'xml',
      	      'sensor' => 'false',
      	      'key' => sfConfig::get('sf_google_key'),
      	      'q' => $request->getParameter('to_address')
      	    )
      	);     
      	$xml = new SimpleXMLElement($b->getResponseText());
        if(count($xml->Response->Placemark) > 1){
        	$this->form->getErrorSchema()->addError( 
         	  new sfValidatorError(new sfValidatorPass(), '目的地が複数あります、詳しく入力してください。',array('to_address'))
         	);
        }
        
        $split = explode(',',(string)$xml->Response->Placemark[0]->Point->coordinates);
        $this->form->setDefault('to_address',$request->getParameter('to_address')); 
        $this->form->setDefault('to_lat',$split[1]);
        $this->form->setDefault('to_lon',$split[0]); 
        $this->form->setDefault('from_address',$request->getParameter('from_address')); 
        $this->form->setDefault('from_lat',$request->getParameter('from_lat'));
        $this->form->setDefault('from_lon',$request->getParameter('from_lon')); 
        $this->form->setDefault('depart_date',$depart_date); 
        $this->form->setDefault('depart_time',$depart_time);
        
      }else{
     
       $this->form->bind($request->getParameterHolder()->getAll());
        if ($this->form->isValid())
        {
      	  $depart_date = $this->getRequestParameter('depart_date');
      	  $depart_time = $this->getRequestParameter('depart_time');
      	  
      	  $b->post(sfConfig::get('sf_takutomo_add_event_url'),
      	    array(
      	      'guid' => 'DEBUG,sample_member_001',
      	      'from_address' => $this->getRequestParameter('from_address'),
              'from_lat' => $this->getRequestParameter('from_lat'),
      	      'from_lon' => $this->getRequestParameter('from_lon'),
      	      'to_address' => $this->getRequestParameter('to_address'),
      	      'to_lat' => $this->getRequestParameter('to_lat'),
      	      'to_lon' => $this->getRequestParameter('to_lon'),
      	      'depart_date' => $depart_date['year'].
      	                       sprintf('%02d',$depart_date['month']).
      	                        sprintf('%02d',$depart_date['day']),
      	      'depart_hour' => $depart_time['hour'],
      	      'depart_min' => $depart_time['minute'],
      	      'detail' => $this->getRequestParameter('detail')
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
        }
      }
    }    
  }
}
