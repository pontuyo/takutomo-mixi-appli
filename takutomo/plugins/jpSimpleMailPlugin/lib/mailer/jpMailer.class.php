<?php
/**
 * jpMailer abstruct class
 *
 * jpMailer class is an abstruct class which you can create a warpper class for an each Mail Library.
 *
 * @package    jpSimpleMailPlugin
 * @subpackage lib
 * @author     brt.river <brt.river@gmail.com>
 * @version    $Id: jpMailer.class.php 129 2008-11-29 17:03:40Z brtriver $
 */
abstract class jpMailer
{
  public
    $mailer = null;
  public function __construct()
  {
    $this->initialize();
  }
  public function initialize()
  {}
  public function setMailer($mailer)
  {
    $this->mailer = $mailer;
  }
  public function getMailer()
  {
    return $this->mailer;
  }
  public function setCharset($charset)
  {}
  public function getCharset()
  {}
  public function setContetType($type)
  {}
  public function setPriority($priority)
  {}
  public function getPriority()
  {}
  public function setEncoding($encoding)
  {}
  public function getEncoding()
  {}
  public function setReturnPath($address)
  {}
  public function getReturnPath()
  {}
  public function addTo($address, $name = null)
  {}
  public function setFrom($address, $name = null)
  {}
  public function addCc($address, $name = null)
  {}
  public function addBcc($address, $name = null)
  {}
  public function setSubject($subject)
  {}
  public function setBody($body)
  {}
  public function addReplyTo($reply_to)
  {}
  public function getFrom()
  {}
  public function getSubject()
  {}
  public function getBody()
  {}
  public function getReplyTo()
  {}
  public function clearTo()
  {}
  public function clearCc()
  {}
  public function clearBcc()
  {}
  public function clearReplyTo()
  {}
  public function send()
  {}
  public function __call($name, $args)
  {
    throw new sfException(sprintf('%s is undefiend method in %s class', $name, get_class($this)));
  }
}