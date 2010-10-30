<?php
ini_set('include_path', '../../lib/PEAR' . PATH_SEPARATOR . ini_get('include_path'));

require_once('OAuth.php');

class MixiAppMobileApi{
	
	static	$consumer;	
	static	$consumerKey	= '';//設定して下さい
	static	$consumerSecret	= '';//設定して下さい
	static	$appId		= '';
	static	$ownerId	= '';
	
	var 	$rawData;
	
		public static function initWithConsumer($key,$secret){
		self::$consumerKey		= $key;
		self::$consumerSecret	= $secret;
		self::init();
	}
	
	static function init(){
	
		if(isset($_GET['opensocial_app_id'])){
			self::$appId	= $_GET['opensocial_app_id'];
		}
		
		if(isset($_GET['opensocial_owner_id'])){
			self::$ownerId	= $_GET['opensocial_owner_id'];
		}
		
		self::$consumer	= new OAuthConsumer(
			self::$consumerKey,
			self::$consumerSecret,
			null
		);
		
	}
	
	function MixiAppMobileApi(){
		if(!isset(self::$consumer)){self::init();}
	}
	
	public function get($url)		{ return( $this->request($url) );		}
	public function post($url,$data)	{ return( $this->request($url,$data) );		}
	public function delete($url)		{ return( $this->request($url,null,'DELETE') );	}
	
	function request($url,$data=null,$method=null){
		
		switch(true){
			case(isset($data)):
				$options	= array('method' => 'POST', 'content' => json_encode($data));
				break;

			case(empty($method)):
				$options	= array('method' => 'GET');
				break;

			default:
				$options	= array('method' => $method);

		}
		
		list($baseFeed,$queryString)	= explode('?', $url, 2);
		
		$parameters		= $this->parameters($queryString);
		$options['header']	= $this->header(
			OAuthRequest::from_consumer_and_token(
				self::$consumer,
				null,
				$options['method'],
				$baseFeed,
				$parameters
			)
		);
		
		$this->rawData	= file_get_contents(
			$baseFeed . '?' . http_build_query($parameters,'','&'),
			null,
			stream_context_create(array('http' => $options))
		);

		return((json_decode($this->rawData)));
		
	}
	
	function parameters($queryString=null){
		$parameters	= array(
			'xoauth_requestor_id' => self::$ownerId,
		);
		if(isset($queryString)){
			parse_str($queryString,$q);
			$parameters += $q;
		}
		return($parameters);
	}
		
	function header($request){
		$request->sign_request(
			new OAuthSignatureMethod_HMAC_SHA1(),
			self::$consumer,
			null
		);
		$rows = array(
			'Content-Type: application/json',
			$request->to_header(),
			'',
		);
		return(implode("\r\n",$rows));
	}
	
	function id($string){
		list($null,$id) = explode(':',$string);
		return($id);
	}
	
	private function encode($data){
	  if(!empty($data)){
	    foreach($data as $key => &$value){
	      if(is_object($value)){
	        foreach($value as $key2 => &$value2){
	          if(is_object($value2)){
	            foreach($value2 as $key3 => &$value3){
	              if(is_object($value3)){
	              	
	              }else{
	                $value3 = mb_convert_encoding($value3, 'SJIS', 'UTF-8');
	              }
	            }
	            
	          }else{
	            $value2 = mb_convert_encoding($value2, 'SJIS', 'UTF-8');
	          }
	        }
	      }else{
	       // $value = mb_convert_encoding($value, 'UTF-8', 'SJIS');
	      }
	      
	    }	
	  }
	  return $data;
	}
	

	
}

?>