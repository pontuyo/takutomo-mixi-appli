<?php
/*
 * Created on 2010/05/15
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 * google geocodeをパースして連想配列で返します
 */
 function geocodeParser($object){
   $result = array();
   
   switch ($object['AddressDetails']['Accuracy'])
   {
     case 0:
       $result['address'] = countryParser($object['AddressDetails']);
       break;
////     case "1":
////       $result['address'] = (string)$country->CountryName;
////       break;
////     case "2":
////       $result['address'] = (string)$country->AdministrativeArea->CountryName;
////       $result['address'] .= (string)$country->AdministrativeArea->AdministrativeAreaName;
////       break;
////     case "3":
////       $result['address'] = (string)$country->AdministrativeArea->CountryName;
////       $result['address'] .= (string)$country->AdministrativeArea->AdministrativeAreaName;
////       $result['address'] .= (string)$country->Locality->LocalityName;
////       break;
     case 4:
     case 5:
     case 6:
     case 7:
     case 8:
       $result['address'] = administrativeAreaParser($object['AddressDetails']['Country']);
       break;
     case 9:

       $result['address'] = countryParser($object['AddressDetails']);
       break;
   }
   $split = explode(',',$object['Point']['coordinates']);
   $result['lat'] = $split[1];
   $result['lon'] = $split[0];
   
   return $result;
 }
 
 function countryParser($value){
 	if(!empty($value['Country'])){
 	  return $value['Country']['AddressLine'];
 	}else{
 	   return $value['AddressLine'];	
 	}
 }
 
 function administrativeAreaParser($value){
 	$result = "";
 	if(!empty($value['AdministrativeArea'])){
 	  $result .= $value['AdministrativeArea']['AdministrativeAreaName'];
 	  if(!empty($value['AdministrativeArea']['SubAdministrativeArea'])){
 	   $result .= $value['AdministrativeArea']['SubAdministrativeArea']['SubAdministrativeAreaName'];
 	   $result .= localityParser($value['AdministrativeArea']['SubAdministrativeArea']);
 	  }else{
 	    $result .= localityParser($value['AdministrativeArea']);
 	  }
 		
 	}
 	return $result;
 }
 
 function localityParser($value){
 	if(!empty($value['Locality'])){
 	  $result = $value['Locality']['LocalityName'];
 	  if(!empty($value['Locality']['DependentLocality'])){
 	    $result .= $value['Locality']['DependentLocality']['DependentLocalityName'];
 	  }
 	  if(!empty($value['Locality']['DependentLocality']['Thoroughfare'])){
 	    $result .= $value['Locality']['DependentLocality']['Thoroughfare']['ThoroughfareName'];
 	  }
 	  
 	  return $result;
 	}
 	return "";
 }
?>
