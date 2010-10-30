<?php
/*
 * Created on 2010/04/13
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class ForgotPasswordForm extends sfForm
 {
 	public function configure()
    {   
      $this->setWidgets(array(
      'email' => new sfWidgetFormInputText(),
      'password' => new sfWidgetFormInputText()
      ));
      
      $this->widgetSchema->setLabels(array(
       'email'    => 'メールアドレス',
       'password'   => 'パスワード'
        ));  
        
     $this->setValidators(array(
       'email'=> new sfValidatorAnd(
          array(
                   new sfValidatorString(),
                   new sfValidatorEmail(),
          ),
          array(),
          array('required'=>'メールアドレスを入力してください。',
                'invalid' => 'メールアドレスが不正です。')
       )
      ));
    $this->validatorSchema->setOption('allow_extra_fields', true);
    
  }
    
}
 
?>
