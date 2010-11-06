<?php
/**
 * jpSwiftMailer class
 *
 * @package    jpSimpleMailPlugin
 * @subpackage lib
 * @author     brt.river <brt.river@gmail.com>
 * @version    $Id: jpSwiftMailer.class.php 129 2008-11-29 17:03:40Z brtriver $
 */
class jpSwiftMailer extends jpMailer
{
  public
    $address = "",
    $message = "",
    $from = "";
  public function initialize()
  {
    $this->setMailer(new Swift(new Swift_Connection_NativeMail()));
    mb_language('Ja');
    $this->message = new Swift_Message();
    $this->message->setHeaders(new Swift_Message_jpHeaders());
    $this->message->setContentType('text/plain');
    $this->setCharset('iso-2022-jp');
    $this->setEncoding('7bit');
    $this->address = new Swift_RecipientList();
  }
  public function setCharset($charset)
  {
    $this->message->setCharset($charset);
  }
  public function getCharset()
  {
    return $this->message->getCharset();
  }
  public function setPriority($priority)
  {
    $this->message->setPriority($priority);
  }
  public function getPriority()
  {
    return $this->message->getPriority();
  }
  public function setEncoding($encoding)
  {
    $this->message->setEncoding($encoding);
  }
  public function getEncoding()
  {
    return $this->message->getEncoding();
  }
  public function setSender($address, $name = null)
  {
    if (!$address) {
      return;
    }
    if ($name == null) {
      list($address, $name) = jpSimpleMail::splitAddress($address);
    }
    $this->message->setReturnPath($address);
  }
  public function getSender()
  {
    return $this->message->getReturnPath();
  }
  public function setReturnPath($address)
  {
    $this->message->setReturnPath($address);
  }
  public function getReturnPath()
  {
    return $this->message->getReturnPath();
  }
  public function addAddress($address, $name = null)
  {
    $this->addTo($address, $name);
  }
  public function addTo($address, $name = null)
  {
    if ($name == null)
    {
      list($address, $name) = jpSimpleMail::splitAddress($address);
    }
    $name = jpSimpleMail::mb_encode_mimeheader($name);
    $this->address->addTo($address, $name);
  }
  public function setFrom($address, $name = null)
  {
    if (!$address) {
      return;
    }
    if ($name == null)
    {
      list($address, $name) = jpSimpleMail::splitAddress($address);
    }
    $this->mailer->From     = $address;
    $name = jpSimpleMail::mb_encode_mimeheader($name);
    $this->from = new Swift_Address($address, $name);
  }
  public function addCc($address, $name = null)
  {
    if ($name == null) {
      list($address, $name) = jpSimpleMail::splitAddress($address);
    }
    $name = jpSimpleMail::mb_encode_mimeheader($name);
    $this->address->addCc($address, $name);
  }
  public function addBcc($address, $name = null)
  {
    if ($name == null) {
      list($address, $name) = jpSimpleMail::splitAddress($address);
    }
    $name = jpSimpleMail::mb_encode_mimeheader($name);
    $this->address->addBcc($address, $name);
  }
  public function setSubject($subject)
  {
    $this->message->setSubject($subject);
  }
  public function setBody($body)
  {
    $body = mb_convert_encoding($body, $this->getCharset(), mb_internal_encoding());
    $this->message->setBody($body);
  }
  public function setAltBody($body)
  {
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
    $this->message->setReplyTo(array($address => $name));
  }
  public function getFrom()
  {
    if (! $this->from instanceof Swift_Address) return "";
    return $this->from->getAddress();
  }
  public function getSubject()
  {
    return $this->message->getSubject();
  }
  public function getBody()
  {
    return mb_convert_encoding($this->message->getBody(), mb_internal_encoding(), $this->getCharset());
  }
  public function clearTo()
  {
    $this->address->flushTo();
  }
  public function clearCcs()
  {
    $this->address->flushCc();
  }
  public function clearBccs()
  {
    $this->address->flushBcc();
  }
  public function clearReplyTo()
  {
    $this->message->setReplyTo('');
  }
  public function send()
  {
    try {
      $this->mailer->send($this->message, $this->address, $this->from);
      $this->mailer->disconnect();
      return true;
    } catch ( Exception $e) {
      $this->mailer->disconnect();
      throw new jpSendMailException($e);
    }
  }
}

/**
 * Swift_Message_jpHeader class
 *
 * Custmize Swift_Message_Header class for iso-2022-jp
 *
 * @package    jpSimpleMailPlugin
 * @subpackage lib
 * @author     brt.river <brt.river@gmail.com>
 * @version    $Id: jpSwiftMailer.class.php 129 2008-11-29 17:03:40Z brtriver $
 */
class Swift_Message_jpHeaders extends Swift_Message_Headers
{
  public function __construct()
  {
    $this->setCharset('iso-2022-jp');
  }
  public function getEncoded($name)
  {
    //      return parent::getEncoded($name);
    if ($this->getCharset() == 'iso-2022-jp' && (strtolower($name) == "subject")) {
      $encoded_value = (array)$this->get($name);
      foreach ($encoded_value as $key => $value ) {
        $encoded_value[$key] = mb_encode_mimeheader($value, $this->getCharset(), 'B', "\n");
      }
      //If there are multiple values in this header, put them on separate lines, cleared by commas
      $lname = strtolower($name);
      //Append attributes if there are any
      $this->cached[$lname] = implode("," . $this->LE . " ", $encoded_value);
      if (!empty($this->attributes[$lname])) $this->cached[$lname] .= $this->buildAttributes($this->cached[$lname], $lname);
      return $this->cached[$lname];
    } else {
      return parent::getEncoded($name);
    }
  }
}
