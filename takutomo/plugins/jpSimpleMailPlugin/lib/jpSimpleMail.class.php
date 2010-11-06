<?php
/**
 * jpSimpleMail class for create the instance of the mailer library
 *
 * @package    jpSimpleMailPlugin
 * @subpackage jpSimpleMail
 * @author     brt.river <brt.river@gmail.com>
 * @version    $Id: jpSimpleMail.class.php 132 2008-11-29 17:45:59Z brtriver $
 */
class jpSimpleMail
{
  /**
   * Factory method
   *
   * @param string $mailer: the name of the instance
   *                        'PHPMailer', 'SwiftMailer', 'Qdmail' for default
   * 
   * @return object $class: the created instance
   */
  public static function create($mailer)
  {
    $class = sprintf("jp%s", $mailer);
    return new $class;
  }
  /**
   * Filter the values
   *
   * @param string $value: the value before
   *
   * @return string the value after
   */
  public static function filter($value)
  {
    return str_replace("\x00", "", trim($value));
  }
  /**
   * Convert encoding and filter value
   *
   * @param string $value : the value before
   *
   * @return string the value after
   */
  public static function mb_encode_mimeheader($value)
  {
    $value = self::filter($value);
    return mb_encode_mimeheader($value, 'iso-2022-jp', 'B', "\n");
  }
  /**
   * Divide an address into the name part and the address part.
   *
   * @param string $address: the address
   *
   * @return array array('the address part', 'the name part')
   */
  public static function splitAddress($address)
  {
    if (preg_match('/^(.+)\s<(.+?)>$/', $address, $matches)) {
      return array($matches[2], $matches[1]);
    } else {
      return array($address, '');
    }
  }
}