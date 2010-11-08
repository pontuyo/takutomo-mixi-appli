<?php
ini_set('include_path', '../../lib/PEAR' . PATH_SEPARATOR . ini_get('include_path'));
require_once 'XML/Unserializer.php';

/*
 * Created on 2010/11/08
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 * idを元にユーザーの評価を取得して☆を返します
 */
function getEval($id){
   $result =null;
   
    $b = new sfWebBrowser();
     $b->post(sfConfig::get('sf_takutomo_get_profile_url'),
      	    array(
      	      'id' => $id
      	      )
      	  );
      $xml = new SimpleXMLElement($b->getResponseText());
     if((int)$xml->status->code >= 1000 ){
     	return null;
     }else{
       //xmlを連想配列に変換
       $options = array(
         'complexType'       => 'array'
       );
         	
       $Unserializer = new XML_Unserializer($options);
       $status = $Unserializer->unserialize($b->getResponseText());
       if($status){
         $member= $Unserializer->getUnserializedData();
         return createStars(calculateEvaluate($member));
       }
       
       return null;

     }   
}
 
function calculateEvaluate($member)
{
  $evaluate = 0;
  if(intval($member['profile']['eval_good']) > 0)
    $evaluate += intval($member['profile']['eval_good']);
  //普通は反映しない
  #if(intval($member['profile']['eval_normal']) > 0)
  #  $evaluate += intval($member['profile']['eval_normal']);

  if(intval($member['profile']['eval_bad']) > 0)
    $evaluate -= intval($member['profile']['eval_bad']);
    
  return $evaluate;
}
 
function createStars($evaluate)
{
    if($evaluate > 0){
  	  #評価星作成
  	  $evaluate_max_number = sfConfig::get('sf_evaluate_max_number');
  	  if($evaluate > $evaluate_max_number)$evaluate = $evaluate_max_number;
  	  $evaluateChar ="";
  	  for($i =0;$i<$evaluate;$i++){
  	  	$evaluateChar .="☆";
  	  }
  	  return $evaluateChar;
  } else{
  	  return "なし";
  }
} 
 
?>
