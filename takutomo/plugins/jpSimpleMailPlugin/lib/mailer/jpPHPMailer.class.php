<?php
/**
 * jpPHPMailer class
 *
 * @package    jpSimpleMailPlugin
 * @subpackage lib
 * @author     brt.river <brt.river@gmail.com>
 * @version    $Id: jpPHPMailer.class.php 129 2008-11-29 17:03:40Z brtriver $
 */
class jpPHPMailer extends jpMailer
{
  public function initialize()
  {
    $this->setMailer(new PHPMailer);
    mb_language('Ja');
    $this->setCharset('iso-2022-jp');
    $this->setEncoding('7bit');
  }
  public function setCharset($charset)
  {
    $this->mailer->CharSet = $charset;
  }
  public function getCharset()
  {
    return $this->mailer->CharSet;
  }
  public function setPriority($priority)
  {
    $this->mailer->Priority = $priority;
  }
  public function getPriority()
  {
    return $this->mailer->Priority;
  }
  public function setEncoding($encoding)
  {
    $this->mailer->Encoding = $encoding;
  }
  public function getEncoding()
  {
    return $this->mailer->Encoding;
  }
  public function setSender($address, $name = null)
  {
    if (!$address) {
      return;
    }
    if ($name == null) {
      list($address, $name) = jpSimpleMail::splitAddress($address);
    }
    $this->setReturnPath($address);
  }
  public function getSender()
  {
    return $this->getReturnPath();
  }
  public function setReturnPath($address)
  {
    $this->mailer->Sender = $address;
  }
  public function getReturnPath()
  {
    return $this->mailer->Sender;
  }
  public function addAddress($address, $name = null)
  {
    $this->addTo($address, $name);
  }
  public function addTo($address, $name = null)
  {
    if ($name == null) {
      list($address, $name) = jpSimpleMail::splitAddress($address);
    }
    $name = jpSimpleMail::mb_encode_mimeheader($name);
    $this->mailer->AddAddress($address, $name);
  }
  public function setFrom($address, $name = null)
  {
    if (!$address) {
      return;
    }
    if ($name == null) {
      list($address, $name) = jpSimpleMail::splitAddress($address);
    }
    $this->mailer->From     = $address;
    $name = jpSimpleMail::mb_encode_mimeheader($name);
    $this->mailer->FromName = $name;
  }
  public function addCc($address, $name = null)
  {
    if ($name == null) {
      list($address, $name) = jpSimpleMail::splitAddress($address);
    }
    $name = jpSimpleMail::mb_encode_mimeheader($name);
    $this->mailer->AddCc($address, $name);
  }
  public function addBcc($address, $name = null)
  {
    if ($name == null) {
      list($address, $name) = jpSimpleMail::splitAddress($address);
    }
    $name = jpSimpleMail::mb_encode_mimeheader($name);
    $this->mailer->AddBcc($address, $name);
  }
  public function setSubject($subject)
  {
    $subject = jpSimpleMail::mb_encode_mimeheader($subject);
    $this->mailer->Subject = $subject;
  }
  public function setBody($body)
  {
    $body = mb_convert_encoding($body, $this->getCharset(), mb_internal_encoding());
    $this->mailer->Body = $body;
  }
  public function setAltBody($body)
  {
    $body = mb_convert_encoding($body, $this->getCharset(), mb_internal_encoding());
    $this->mailer->setAltBody($body);
  }
  public function addReplyTo($address, $name = null)
  {
    if (!$address) {
      return;
    }
    if ($name == null) {
      list($address, $name) = jpSimpleMail::splitAddress($address);
    }
    $name = jpSimpleMail::mb_encode_mimeheader($name);
    $this->mailer->AddReplyTo($address, $name);
  }
  public function getFrom()
  {
    return $this->mailer->From;
  }
  public function getSubject()
  {
    return mb_decode_mimeheader($this->mailer->Subject);
  }
  public function getBody()
  {
    return mb_convert_encoding($this->mailer->Body, mb_internal_encoding(), $this->getCharset());
  }
  public function clearTo()
  {
    $this->mailer->ClearAddresses();
  }
  public function clearCcs()
  {
    $this->mailer->ClearCcs();
  }
  public function clearBccs()
  {
    $this->mailer->ClearBccs();
  }
  public function clearReplyTo()
  {
    $this->mailer->ClearReplyTos();
  }
  public function send()
  {
    if (!$this->mailer->Send()) {
      throw new jpSendMailException($this->mailer->ErrorInfo);
    }
    return true;
  }
}