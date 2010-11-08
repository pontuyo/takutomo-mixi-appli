<?php

/**
 * inquiry actions.
 *
 * @package    takutomo
 * @subpackage inquiry
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inquiryActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->form = new InquiryForm();
    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameterHolder()->getAll());
     
      if ($this->getRequestParameter('adjustment') == '' && $this->form->isValid())
      {
      	$this->form->freeze();
      	$this->setTemplate('confirm');
      }
    }
    
  }
  
  /**
   * 送信完了画面
   */
  public function executeSubmit(sfWebRequest $request)
  {
    $this->sendMail();
     
  }
  
  /**
   * メール送信処理
   */
  private function sendMail()
  {
  	//メールを送信する処理
//    $mailer = jpSimpleMail::create('SwiftMailer4'); // このサンプルではSwift Mailerを利用しています。
//    $mailer->setSubject('メール送信テストです');
//    $mailer->setSender('kobari1984@gmail.com');
//    $mailer->addTo(sprintf('%s <%s>', '宛先　太郎', 'kobari1984@gmail.com'));
//    $mailer->setFrom(sprintf('%s <%s>', '管理者', 'kobari1984@gmail.com'));
//    $mailer->setBody('本文です');
////    var_dump($mailer->getFrom());
//    try{
//    	$rs = $mailer->send();
//    }catch(jpSendMailException $e){
//    	echo 'exception';
//    }
//    
//    var_dump($rs);
    
    mb_language('ja');
    mb_internal_encoding('UTF-8');
    $to = sfConfig::get('sf_iquiry_mail');//宛先 
    $subject = "お問い合わせ"; //題名
    $body = $this->getRequestParameter('message'); //本文
    $from = sfConfig::get('sf_iquiry_mail'); //差出人
 
    //これでは文字化け！
    mail($to,$subject,$body,"From:".$from);
  }
  
}
