<?php
//@require 'Swift/Mime/Headers/AbstractHeader.php';
//@require 'Swift/Mime/HeaderEncoder.php';

/**
 * 日本語(ISO-2022-JP)用メールヘッダクラス
 * @package kzlJpSwiftMailerPlugin
 * @subpackage Mime
 * @author kawaguchi
 * @url http://www.kuzilla.co.jp/
 */
class kzl_Jp_Swift_Mime_Headers_UnstructuredHeader
  extends Swift_Mime_Headers_UnstructuredHeader
{
  // override
  public function getFieldBody()
  {
    if (!$this->getCachedValue())
    {
      // ISO-2022-JP対応
      if (strcasecmp($this->getCharset(), 'iso-2022-jp') === 0)
      {
        // TODO:: エンコードを内包するパターンでSubjectがMIMEエンコードされているのを確認
        // subjectをセットする際にエンコードするのでここでは何もしない
        //$this->setCachedValue($this->getValue());
        // エンコード内包する場合。（本来はこちらが正しいかも）
        $this->setCachedValue(jpSimpleMail::mb_encode_mimeheader(( $this->getValue())));
      } else {
        parent::getFieldBody();
      }
    }
    return $this->getCachedValue();
  }  
}