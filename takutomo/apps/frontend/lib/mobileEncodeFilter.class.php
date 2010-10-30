<?php
/**
 * 携帯用に文字コードを変換します。
 * PHP内部ではUTF-８、出力時はShift_JIS
 * @package lib
 */
class mobileEncodeFilter extends sfFilter{
 
 public function execute($filterChain)
 { 
   $response = $this->getContext()->getResponse();
    
    if ($this->isFirstCall())
    {
      $agent = $this->getContext()->getRequest()->getAttribute('userAgent');
      if($agent->isDoCoMo())
      {
        $response->setContentType('application/xhtml+xml; charset=Shift_JIS');
      }else
      {
         $response->setContentType('text/html; charset=Shift_JIS');
      }
      
      $ph = $this->getContext()->getRequest()->getParameterHolder();
      foreach($ph->getAll() as $key=>$value)
      {
      	if(!is_array($value))
          $ph->set($key, mb_convert_encoding(($value), 'UTF-8', 'SJIS'));
      }
    }
       
    $filterChain->execute();
    
    $contents = $response->getContent();
    
    $response->setContent(mb_convert_encoding(($contents), 'SJIS', 'UTF-8'));
 }
}
?>