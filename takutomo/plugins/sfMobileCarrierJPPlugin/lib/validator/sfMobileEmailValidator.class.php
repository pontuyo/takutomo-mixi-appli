<?php

/**
 * usage (yaml):
 * 
 *   class:   sfMobileEmailValidator
 *   param:
 *     expect: 'valid' # or 'notvalid'
 *     error_msg: 携帯のアドレスを入力してください
 */
class sfMobileEmailValidator extends sfValidator
{
  const VALID = 'valid';
  const NOT_VALID = 'notvalid';
  
  public function initialize($context, $parameters = null)
  {
    // initialize parent
    parent::initialize($context);

    // set defaults
    $this->getParameterHolder()->set('expect', self::VALID);
    $this->getParameterHolder()->set('error_msg', "address seems to have an error");

    $this->getParameterHolder()->add($parameters);

    return true;
  }

  public function execute(&$value, &$error)
  {
    $is_mobile = sfMobileCarrierJP::isMobileEmailAddress($value);
    $param = $this->getParameterHolder();
    
    if ($param->get('expect') === self::VALID && $is_mobile === true) {
      return true;
    }
    elseif ($param->get('expect') === self::NOT_VALID && $is_mobile === false) {
      return true;
    }
    else {
      $error = $this->getParameterHolder()->get('error_msg');
      return false;
    }
  }
}