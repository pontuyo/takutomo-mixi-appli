<?php

class sfMobileTool {

 private static function checkMobile()
  {
    //NTT DoCoMo  
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'DoCoMo') !== false)
      return 'application/xhtml+xml';  
    
    //旧J-PHONE～vodafoneの2G  
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'J-PHONE') !== false)
      return 'text/html';
    
    //vodafoneの3G  
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'Vodafone') !== false)
      return 'text/html';  
    
    //vodafoneの702MOシリーズ  
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'MOT') !== false)
      return 'text/html';  
    
    //SoftBankの3G  
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'SoftBank') !== false)
      return 'text/html';  
    
    //au (KDDI)  
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'PDXGW') !== false)
      return 'text/html';  
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'UP\.Browser') !== false)
      return 'text/html';  
    
    //ASTEL  
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'ASTEL') !== false)
      return 'text/html';  
    
    //DDI Pocket  
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'DDIPOCKET') !== false)
      return 'text/html';  

    return 'text/html';
  }

  public static function rewriteHttpMeta()
  {
    $contentType = sfMobileTool::checkMobile();
    
    // HTTP HEADER
    sfContext::getInstance()->getResponse()->setContentType($contentType);
    
    // HTTP META
    sfContext::getInstance()->getResponse()->addHttpMeta('Content-Type', $contentType);
  }

  public static function rewriteDocType()
  {
    $docType = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'; 
    
    if(strpos($_SERVER['HTTP_USER_AGENT'], "DoCoMo") !== false)
      $docType = '<!DOCTYPE html PUBLIC "-//i-mode group (ja)//DTD XHTML i-XHTML(Locale/Ver.=ja/1.0) 1.0//EN" "i-xhtml_4ja_10.dtd">';
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'SoftBank') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'MOT') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Vodafone') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'J-PHONE') !== false)
      $docType = '<!DOCTYPE html PUBLIC "-//J-PHONE//DTD XHTML Basic 1.0 Plus//EN" "xhtml-basic10-plus.dtd">';
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'PDXGW') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'UP.Browser') !== false)
      $docType = '<!DOCTYPE html PUBLIC "-//OPENWAVE//DTD XHTML 1.0//EN" "http://www.openwave.com/DTD/xhtml-basic.dtd">';


    return $docType;
  }

}
?>