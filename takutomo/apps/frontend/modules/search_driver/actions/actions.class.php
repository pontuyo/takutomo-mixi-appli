<?php
ini_set('include_path', '../../lib/PEAR' . PATH_SEPARATOR . ini_get('include_path'));
require_once 'XML/Unserializer.php';

/**
 * search_driver actions.
 *
 * @package    takutomo
 * @subpackage search_driver
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
 
class search_driverActions extends sfActions
{
  var $from_error = "出発地を入力してください。";
  
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->form = new SearchDriverForm();
    $b = new sfWebBrowser();
    $now = strtotime('+2 hour');
    $depart_date = array('year'=>date('Y',$now),
            'month'=> date('n',$now),
            'day'=>date('j',$now));
    $depart_time = array('hour'=>date('G',$now),
            'minute'=> 0);
    
    $mixi = new MixiAppMobileApi;
    $persistence = $mixi->get(sfConfig::get('sf_opensocial_persistence_api'));
    $mixi_persistence = $persistence->entry->{'mixi.jp:'.MixiAppMobileApi::$ownerId};
    
    
//      $request->setParameter('lat',GpsConverter::dmsToDegree($this->getRequestParameter('lat')));
//      $request->setParameter('lon',GpsConverter::dmsToDegree($this->getRequestParameter('lon')));

      
      //初期値設定
      $this->form->setDefault('from_address',$mixi_persistence->from_address); 
      $this->form->setDefault('from_lat',$mixi_persistence->from_lat); 
      $this->form->setDefault('from_lon',$mixi_persistence->from_lon);
      $this->form->setDefault('to_address',$mixi_persistence->to_address); 
      $this->form->setDefault('to_lat',$mixi_persistence->to_lat); 
      $this->form->setDefault('to_lon',$mixi_persistence->to_lon);
      $this->form->setDefault('category',$mixi_persistence->category);
      
      $this->form->setDefault('depart_date',$depart_date); 
      $this->form->setDefault('depart_time',$depart_time);
      $this->from_address = $mixi_persistence->from_address;
      $this->to_address = $mixi_persistence->to_address;

    
       
  }
  
  public function executeList(sfWebRequest $request)
  {
    
    //mixiサーバから値取得
    if($request->isMethod('get')){
      $mixi = new MixiAppMobileApi;
      $persistence = $mixi->get(sfConfig::get('sf_opensocial_persistence_api'));
      $mixi_persistence = $persistence->entry->{'mixi.jp:'.MixiAppMobileApi::$ownerId};
      $request->setParameter('to_address',$mixi_persistence->to_address);
      $request->setParameter('to_lon',$mixi_persistence->to_lon);
      $request->setParameter('to_lat',$mixi_persistence->to_lat);
      $request->setParameter('from_address',$mixi_persistence->from_address);
      $request->setParameter('from_lon',$mixi_persistence->from_lon);
      $request->setParameter('from_lat',$mixi_persistence->from_lat);
      $request->setParameter('category',$mixi_persistence->category);
      $request->setParameter('depart_date',
        array('year' => $mixi_persistence->depart_year,
              'month' => $mixi_persistence->depart_month,
              'day' => $mixi_persistence->depart_day)
      );
      $request->setParameter('depart_time',
        array('hour' => $mixi_persistence->depart_hour,
              'minute' => $mixi_persistence->depart_min)
      );
      
    }else if($request->isMethod('post')){
      //mixiサーバに値設定
      $depart_date = $this->getRequestParameter('depart_date');
      $depart_time = $this->getRequestParameter('depart_time');
      $mixi = new MixiAppMobileApi;
      $mixi->post(sfConfig::get('sf_opensocial_persistence_api'),
      array(
         'to_address' => $this->getRequestParameter('to_address'),
         'to_lon' => $this->getRequestParameter('to_lon'),
         'to_lat' => $this->getRequestParameter('to_lat'),
         'from_address' => $this->getRequestParameter('from_address'),
         'from_lon' => $this->getRequestParameter('from_lon'),
         'from_lat' => $this->getRequestParameter('from_lat'),
         'category' => $this->getRequestParameter('category'),
         'depart_year' => $depart_date['year'],
      	 'depart_month' => $depart_date['month'],
      	 'depart_day' => $depart_date['day'],
      	 'depart_hour' => $depart_time['hour'],
      	  'depart_min' => $depart_time['minute']
         )
         );
    }
    
    
    //タクトモAPIにアクセス
    $this->form = new SearchDriverForm();
    $b = new sfWebBrowser();
  	  $this->from_address = $this->getRequestParameter('from_address');
      $this->to_address = $this->getRequestParameter('to_address');
      $this->form->bind($request->getParameterHolder()->getAll());
      
      if ($this->form->isValid())
      {
      	  $this->display_category = SearchDriverForm::$categories[$this->getRequestParameter('category')];
      	  $depart_date = $this->getRequestParameter('depart_date');
      	  $depart_time = $this->getRequestParameter('depart_time');
      	            
      	  $b->post(sfConfig::get('sf_takutomo_search_driver_url'),
      	    array(
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
      	      'depart_min' =>  sprintf('%02d',$depart_time['minute']),
      	      'category' => $this->display_category
      	    )
      	  );

        $xml = new SimpleXMLElement($b->getResponseText()); 
      	 
      	 //print $b->getResponseText();
         //print((string)$xml->status->code);
         if((int)$xml->status->code >= 1000){
         	$this->form->getErrorSchema()->addError( 
         	new sfValidatorError(new sfValidatorPass(), (string)$xml->status->description));
         	$this->setTemplate('index');
         }else{

         	//xmlを連想配列に変換
         	$options = array(
                    'complexType'       => 'array'
                );
          // print $b->getResponseText();
           $Unserializer = new XML_Unserializer($options);           
           $status = $Unserializer->unserialize($b->getResponseText());
           if ($status === true) {
            
             $this->list = $Unserializer->getUnserializedData();
             //print_r($this->list);             
           }
            
           
         }
         $this->display_description = (string)$xml->status->description;
         
      }else{
      	 $this->setTemplate('index');
          //$this->forward("search_driver", "index");
      }
  }
  
  public function executeFrom(sfWebRequest $request)
  {
  	$this->form = new sfForm();
  	 if ($request->isMethod('post')){
  	   if($request->getParameter('from_address') == ""){
  	     $this->form->getErrorSchema()->addError( 
         new sfValidatorError(new sfValidatorPass(), $this->from_error));
  	   }else{
  	     $b = new sfWebBrowser();
  	     $b->get(sfConfig::get('sf_google_geo_url'),
      	    array('output' => 'xml',
      	      'sensor' => 'false',
      	      'key' => sfConfig::get('sf_google_key'),
      	      'q' => $request->getParameter('from_address')
      	    )
      	);
      	
      	$this->viewList($request,$b,"fromConfirm");
  	   
  	   } 
  	 }else{
  	 	if($request->getParameter('lat') != "" && 
  	 	  $request->getParameter('lon') != ""){
  	 	  $lon = GpsConverter::dmsToDegree($this->getRequestParameter('lon'));
  	 	  $lat = GpsConverter::dmsToDegree($this->getRequestParameter('lat'));
  	 	  $b = new sfWebBrowser();
  	      $b->get(sfConfig::get('sf_google_geo_url'),
      	    array('output' => 'xml',
      	      'sensor' => 'false',
      	      'key' => sfConfig::get('sf_google_key'),
      	      'll' => $lat.','.$lon
      	    )
      	  );
      	  $this->viewList($request,$b,"fromConfirm");
  	 	}

  	 }
  }
  
  public function executeFromConfirm(sfWebRequest $request)
  {
  	$this->form = new sfForm();
  	$this->display_address = ($request->getParameter('address'));
  }
  public function executeFromSubmit(sfWebRequest $request)
  {
  	$mixi = new MixiAppMobileApi;
  	$mixi->post(sfConfig::get('sf_opensocial_persistence_api'),
  	  array(
	  	'from_address'	=> $request->getParameter('address'),
	  	'from_lon'	=> $request->getParameter('lon'),
	  	'from_lat' => $request->getParameter('lat')
	  )
  	);
    header("Location: ".sfConfig::get('sf_mixi_search_driver_url'));
    exit;
  	//$this->redirect(sfConfig::get('sf_mixi_search_driver_url'));
  }
  
  public function executeTo(sfWebRequest $request)
  {
  	$this->form = new sfForm();
  	 if ($request->isMethod('post')){
  	   if($request->getParameter('to_address') == ""){
  	     $this->form->getErrorSchema()->addError( 
         new sfValidatorError(new sfValidatorPass(), $this->from_error));
  	   }else{
  	     $b = new sfWebBrowser();
  	     $b->get(sfConfig::get('sf_google_geo_url'),
      	    array('output' => 'xml',
      	      'sensor' => 'false',
      	      'key' => sfConfig::get('sf_google_key'),
      	      'q' => $request->getParameter('to_address')
      	    )
      	);        
         $this->viewList($request,$b,"toConfirm");  	   
  	   }    
  	 }else{
  	 	if($request->getParameter('lat') != "" && 
  	 	  $request->getParameter('lon') != ""){
  	 	  $lon = GpsConverter::dmsToDegree($this->getRequestParameter('lon'));
  	 	  $lat = GpsConverter::dmsToDegree($this->getRequestParameter('lat'));
  	 	  $b = new sfWebBrowser();
  	      $b->get(sfConfig::get('sf_google_geo_url'),
      	    array('output' => 'xml',
      	      'sensor' => 'false',
      	      'key' => sfConfig::get('sf_google_key'),
      	      'll' => $lat.','.$lon
      	    )
      	  );
      	  $this->viewList($request,$b,"toConfirm");
  	 	}

  	 }
  }
  
  public function executeToConfirm(sfWebRequest $request)
  {
  	$this->form = new sfForm();
  	$this->display_address = ($request->getParameter('address'));
  }
  
  public function executeToSubmit(sfWebRequest $request)
  {
  	$mixi = new MixiAppMobileApi;
  	$mixi->post(sfConfig::get('sf_opensocial_persistence_api'),
  	  array(
	  	'to_address'	=> $request->getParameter('address'),
	  	'to_lon'	=> $request->getParameter('lon'),
	  	'to_lat' => $request->getParameter('lat')
	  )
  	);
    header("Location: ".sfConfig::get('sf_mixi_search_driver_url'));
    exit;
  	//$this->redirect(sfConfig::get('sf_mixi_search_driver_url'));
  }
  
  
  private function viewList(sfWebRequest $request,sfWebBrowser $b,$module_name){
     	$options = array(
        'complexType'       => 'array',
        'parseAttributes' => TRUE
    );
    $Unserializer = new XML_Unserializer();
    $Unserializer->setOption('parseAttributes', TRUE); 
    $status = $Unserializer->unserialize($b->getResponseText());
    $this->list = $Unserializer->getUnserializedData();

    //検索結果が一件の場合
    if(count($this->list['Response']['Placemark']) >= 1 &&
      $this->list['Response']['Placemark']['id']){
      
      sfApplicationConfiguration::getActive()->loadHelpers('geocodeParser');
      $result = geocodeParser($this->list['Response']['Placemark']);
      $this->display_address = $result['address'];
      $request->setParameter('address',$result['address']);
      $request->setParameter('lon',$result['lon']);
      $request->setParameter('lat',$result['lat']);
      $this->setTemplate($module_name);
    }else{
    	
      $this->module_name = $module_name;
      $this->setTemplate('searchList');
    }
  	
  }
}
