<?php
ini_set('include_path', '../../lib/PEAR' . PATH_SEPARATOR . ini_get('include_path'));
require_once 'XML/Unserializer.php';

/**
 * search_event actions.
 *
 * @package    takutomo
 * @subpackage search_event
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class search_eventActions extends sfActions
{
  var $detail = '同乗者いますか？出発時間は相談応じます。途中下車,乗車も相談OKです';
  var $depart_date;
  var $depart_time;
  var $depart_date_min;
  var $depart_date_max;
  var $G_GEO_UNKNOWN_ADDRESS = "住所が見つかりません。";
  
  
  public function executeIndex(sfWebRequest $request)
  {
    $this->form = new SearchEventForm(); 
    $b = new sfWebBrowser();
    $this->createDepartDate();
                
    $mixi = new MixiAppMobileApi;
    $persistence = $mixi->get(sfConfig::get('sf_opensocial_persistence_api'));
    $mixi_persistence = $persistence->entry->{'mixi.jp:'.MixiAppMobileApi::$ownerId};
    
    if ($request->isMethod('get')){
      //初期値設定
      $this->form->setDefault('from_address',$mixi_persistence->from_address); 
      $this->form->setDefault('from_lat',$mixi_persistence->from_lat); 
      $this->form->setDefault('from_lon',$mixi_persistence->from_lon);
      $this->form->setDefault('to_address',$mixi_persistence->to_address); 
      $this->form->setDefault('to_lat',$mixi_persistence->to_lat); 
      $this->form->setDefault('to_lon',$mixi_persistence->to_lon);
      $this->form->setDefault('category',$mixi_persistence->category);
      $this->form->setDefault('depart_date',$this->depart_date); 
      $this->form->setDefault('depart_time',$this->depart_time);
      //$this->form->setDefault('depart_time',array('from' =>$depart_date_min,'to' =>$depart_date_max));
      $this->from_address = $mixi_persistence->from_address;
      $this->to_address = $mixi_persistence->to_address;
      
      $request->setParameter('detail',$this->detail);

    }else{
     $this->form->bind($request->getParameterHolder()->getAll());
        if ($this->form->isValid())
        {
      	  $depart_time = $this->getRequestParameter('depart_time');
      	  
      	  $b->post(sfConfig::get('sf_takutomo_search_event_url'),
      	    array(
      	      'from_address' => $this->getRequestParameter('from_address'),
              'from_lat' => $this->getRequestParameter('from_lat'),
      	      'from_lon' => $this->getRequestParameter('from_lon'),
      	      'to_address' => $this->getRequestParameter('to_address'),
      	      'to_lat' => $this->getRequestParameter('to_lat'),
      	      'to_lon' => $this->getRequestParameter('to_lon'),
      	      'depart_time_min' => $this->depart_date_min['from']['year'] .
      	                       sprintf('%02d',$this->depart_date_min['month']) .
      	                       sprintf('%02d',$this->depart_date_min['day']) .
      	                       sprintf('%02d',$this->depart_date_min['hour']) .
      	                       sprintf('%02d',$this->depart_date_min['minute']),
      	      'depart_time_max' => $this->depart_date_max['year'] .
      	                       sprintf('%02d',$this->depart_date_max['month']) .
      	                       sprintf('%02d',$this->depart_date_max['day']) .
      	                       sprintf('%02d',$this->depart_date_max['hour']) .
      	                       sprintf('%02d',$this->depart_date_max['minute']),  )
      	  );
      	                    
        $xml = new SimpleXMLElement($b->getResponseText()); 
      	 
         //print((string)$xml->status->code);
         if((int)$xml->status->code >= 1000 ){
           $this->form->getErrorSchema()->addError( 
           new sfValidatorError(new sfValidatorPass(), (string)$xml->status->description)); 
         
         }else if((int)$xml->summary->num_of_result < 1){
           $this->form->getErrorSchema()->addError( 
         	new sfValidatorError(new sfValidatorPass(), '一致する条件がありませんでした。'));
         }else{
         	
         	//xmlを連想配列に変換
         	$options = array(
                    'complexType'       => 'array'
                );
         	
           $Unserializer = new XML_Unserializer($options);
           $status = $Unserializer->unserialize($b->getResponseText());
           //if ($status === true) {
             $this->list = $Unserializer->getUnserializedData();
             //print_r($this->list);
           //}
            
           $this->setTemplate('list');
         }
         $this->display_description = (string)$xml->status->description;
        }
    	
    }
          
  }
  
  public function executeList(sfWebRequest $request)
  {
     $addEvnetFlag = false;
     $this->createDepartDate();
     
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
//      $depart_date_min = array('year'=>$mixi_persistence->from_year,
//            'month'=> $mixi_persistence->from_month,
//            'day'=> $mixi_persistence->from_day,
//            'hour'=> $mixi_persistence->from_hour,
//            'minute'=> $mixi_persistence->from_minute);
//      $depart_date_max = array('year'=>$mixi_persistence->to_year,
//            'month'=> $mixi_persistence->to_month,
//            'day'=> $mixi_persistence->to_day,
//            'hour'=> $mixi_persistence->to_hour,
//            'minute'=> $mixi_persistence->to_minute);

      //$request->setParameter('depart_time',array('from' =>$depart_date_min,'to' =>$depart_date_max));
      
    }else if($request->isMethod('post')){
      
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
//         'from_year' => $this->depart_date_min['year'] ,
//      	 'from_month' => $this->depart_date_min['month'],
//      	 'from_day' => $this->depart_date_min['day'],
//      	 'from_hour' => $this->depart_date_min['hour'],
//      	 'from_min' => $this->depart_date_min['minute'],
//         'to_year' => $this->depart_date_max['year'] ,
//      	 'to_month' => $this->depart_date_max['month'],
//      	 'to_day' => $this->depart_date_max['day'],
//      	 'to_hour' => $this->depart_date_max['hour'],
//      	 'to_min' => $this->depart_date_max['minute']
      	 
         )
       );
       
       if(!($addEvnetFlag = $this->addEvent($request)))
         $this->setTemplate('index');
         
    }
    //タクトモAPIにアクセス
    $this->form = new SearchEventForm();
    $b = new sfWebBrowser();
  	$this->from_address = $this->getRequestParameter('from_address');
    $this->to_address = $this->getRequestParameter('to_address');
      
    $this->form->bind($request->getParameterHolder()->getAll());
    if( ($request->isMethod('post') && $addEvnetFlag && $this->form->isValid())
    || ($request->isMethod('get') && $this->form->isValid()) )
    {
      $depart_time = $this->getRequestParameter('depart_time');
      	  
      $b->post(sfConfig::get('sf_takutomo_search_event_url'),
      array(
      	      'from_address' => $this->getRequestParameter('from_address'),
              'from_lat' => $this->getRequestParameter('from_lat'),
      	      'from_lon' => $this->getRequestParameter('from_lon'),
      	      'to_address' => $this->getRequestParameter('to_address'),
      	      'to_lat' => $this->getRequestParameter('to_lat'),
      	      'to_lon' => $this->getRequestParameter('to_lon'),
      	      'depart_time_min' => $this->depart_date_min['year'] .
      	                       sprintf('%02d',$this->depart_date_min['month']) .
      	                       sprintf('%02d',$this->depart_date_min['day']) .
      	                       sprintf('%02d',$this->depart_date_min['hour']) .
      	                       sprintf('%02d',$this->depart_date_min['minute']),
      	      'depart_time_max' => $this->depart_date_max['year'] .
      	                       sprintf('%02d',$this->depart_date_max['month']) .
      	                       sprintf('%02d',$this->depart_date_max['day']) .
      	                       sprintf('%02d',$this->depart_date_max['hour']) .
      	                       sprintf('%02d',$this->depart_date_max['minute']),      	    )
      	  );
      	                    
      $xml = new SimpleXMLElement($b->getResponseText()); 
         //print((string)$xml->status->code);
         if((int)$xml->status->code >= 1000 ){
           $this->form->getErrorSchema()->addError( 
           new sfValidatorError(new sfValidatorPass(), (string)$xml->status->description)); 
         
         }else if((int)$xml->summary->num_of_result < 1){
           $this->form->getErrorSchema()->addError( 
         	new sfValidatorError(new sfValidatorPass(), '一致する条件がありませんでした。'));
         }else{
         	//検索条件をsessionに格納
         	$this->getUser()->setToAddress($this->getRequestParameter('to_address'));
         	$this->getUser()->setToLon($this->getRequestParameter('to_lon'));
         	$this->getUser()->setToLat($this->getRequestParameter('to_lat'));
         	$this->getUser()->setFromAddress($this->getRequestParameter('from_address'));
         	$this->getUser()->setFromLon($this->getRequestParameter('from_lon'));
         	$this->getUser()->setFromLat($this->getRequestParameter('from_lat'));
         	
         	//xmlを連想配列に変換
         	$options = array(
                    'complexType'       => 'array'
                );
         	
           $Unserializer = new XML_Unserializer($options);
           $status = $Unserializer->unserialize($b->getResponseText());
           if ($status === true) {
             $this->list = $Unserializer->getUnserializedData();
             //print_r($this->list);
           }
            
           $this->setTemplate('list');
         }
         $this->display_description = (string)$xml->status->description;
      }else{
      	$this->setTemplate('index');
      }
  	
  }
  
  
  public function executeFrom(sfWebRequest $request)
  {
  	$this->form = new sfForm();
  	 if ($request->isMethod('post')){
  	   if($this->validate($request->getParameter('from_address'),'出発地'))
  	   {
  	     $b = new sfWebBrowser();
  	     $b->get(sfConfig::get('sf_google_geo_url'),
      	    array('output' => 'xml',
      	      'sensor' => 'false',
      	      'key' => sfConfig::get('sf_google_key'),
      	      'q' => $request->getParameter('from_address')
      	    )
      	);
      	$xml = new SimpleXMLElement($b->getResponseText());
      	if($this->geoCodeValidate($xml)){
      	  $this->viewList($request,$b,"fromConfirm");
      	}
  	   
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
    header("Location: ".sfConfig::get('sf_mixi_search_event_url'));
    exit;
  }
  
  public function executeTo(sfWebRequest $request)
  {
  	$this->form = new sfForm();
  	 if ($request->isMethod('post')){
  	   if($this->validate($request->getParameter('to_address'),'目的地'))
  	   {
  	     $b = new sfWebBrowser();
  	     $b->get(sfConfig::get('sf_google_geo_url'),
      	    array('output' => 'xml',
      	      'sensor' => 'false',
      	      'key' => sfConfig::get('sf_google_key'),
      	      'q' => $request->getParameter('to_address')
      	    )
      	  );
      	  $xml = new SimpleXMLElement($b->getResponseText());
      	 if($this->geoCodeValidate($xml)){
      	  $this->viewList($request,$b,"toConfirm");
      	 }
      	
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
    header("Location: ".sfConfig::get('sf_mixi_search_event_url'));
    exit;
  }
  
  /**
   * マルチバイトトリム
   * @return $str
   */
  private  function mb_trim($str, $chars='\s　') {
    $str = preg_replace("/^[$chars]+/u", '', $str);
    $str = preg_replace("/[$chars]+$/u", '', $str);
    return $str;
  }
  
  /**
   * validate
   */
   private function validate($value,$error_str)
   {
     if($this->mb_trim($value) == ""){
  	   $this->form->getErrorSchema()->addError( 
         new sfValidatorError(new sfValidatorPass(), "{$error_str}を入力してください。"));
       return false;
     }else if(preg_match("/^[a-zA-Z0-9]+$/", mb_convert_kana($value,'a'))){
       $this->form->getErrorSchema()->addError( 
         new sfValidatorError(new sfValidatorPass(), "{$error_str}を正しく入力してください。"));
       return false;
     }
     return true;
   }
  /**
   * geoCodeValidate
   */
   private function geoCodeValidate($xml)
   {
   	 $accuracys = array(0,1,2,3);//位置情報の精度値
     if((int)$xml->Response->Status->code == 602 ){        
         $this->form->getErrorSchema()->addError( 
         new sfValidatorError(new sfValidatorPass(), $this->G_GEO_UNKNOWN_ADDRESS));
      	return false;  
      }else if(strcmp($xml->Response->Placemark->AddressDetails->Country->CountryNameCode,"JP") != 0 ||
       array_search((int)$xml->Response->Placemark->AddressDetails['Accuracy'],$accuracys) !== FALSE){
         $this->form->getErrorSchema()->addError( 
         new sfValidatorError(new sfValidatorPass(), "住所を詳しく入力して下さい。"));
      	return false; 
      }
     return true;
   }   
  
  /**
   *　一覧表示
   */ 
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
  
  /**
   * 相乗りイベント追加
   */
  private function addEvent(sfWebRequest $request)
  {
  	$depart_date = $this->getRequestParameter('depart_date');
  	$depart_time = $this->getRequestParameter('depart_time');
  	$this->addEvnetForm = new AddEventForm();
    $b = new sfWebBrowser();
    $request->setParameter('add_event_depart_date',$depart_date);
    $request->setParameter('add_event_depart_time',$depart_time);
    $this->addEvnetForm->bind($request->getParameterHolder()->getAll());
    
    if ($this->addEvnetForm->isValid())
    {
      $b->post(sfConfig::get('sf_takutomo_add_event_url'),
      array(
      	    'guid' => 'mixi,'.MixiAppMobileApi::$ownerId,
      	    'from_address' => $request->getParameter('from_address'),
            'from_lat' => $request->getParameter('from_lat'),
      	    'from_lon' => $request->getParameter('from_lon'),
      	    'to_address' => $request->getParameter('to_address'),
      	    'to_lat' => $request->getParameter('to_lat'),
      	    'to_lon' => $request->getParameter('to_lon'),
      	    'depart_date' => $depart_date['year'].
      	                       sprintf('%02d',$depart_date['month']).
      	                        sprintf('%02d',$depart_date['day']),
      	    'depart_hour' => $depart_time['hour'],
      	    'depart_min' => sprintf('%02d',$depart_time['minute']),
      	    'detail' => $request->getParameter('detail')
      	    )
      	  );
      	                    
        $xml = new SimpleXMLElement($b->getResponseText()); 
         if((int)$xml->status->code >= 1000){
         	$this->addEvnetForm->getErrorSchema()->addError( 
         	new sfValidatorError(new sfValidatorPass(), (string)$xml->status->description));
         	return false; 
         }else{
           return true;	
         }
         
    }
    
    return false;
      
  }
  
  private function createDepartDate()
  {
    $now = strtotime('+2 hour');  	
  	$this->depart_date = array('year'=>date('Y',$now),
            'month'=> date('n',$now),
            'day'=>date('j',$now));
    $this->depart_time = array('hour'=>date('G',$now),
            'minute'=> 0);
  	
  	//相乗り出発日の開始範囲 
    $now = strtotime('now');
    $this->depart_date_min = array('year'=>date('Y',$now),
            'month'=> date('n',$now),
            'day'=>date('j',$now),
            'hour'=>date('G',$now),
            'minute'=> (int)date('i',$now));
            
    //相乗り出発日の終了範囲 
    $now = strtotime('+2 week');
    $this->depart_date_max = array('year'=>date('Y',$now),
            'month'=> date('n',$now),
            'day'=>date('j',$now),
            'hour'=>date('G',$now),
            'minute'=> (int)date('i',$now));
  }
  
}
