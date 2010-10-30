<?php
/*
 * Created on 2010/04/13
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class LoginForm extends sfForm
 {
 	public function configure()
    {   
      $this->setWidgets(array(
      'email' => new sfWidgetFormInputText(),
      'password' => new sfWidgetFormInputText()
      ));
      //$this->widgetSchema->setNameFormat('member[%s]');
      
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
       ),
       'password' => new sfValidatorString(array(),
                  array('required' => 'パスワードを入力してください。'))
       )
    
      );
    $this->validatorSchema->setOption('allow_extra_fields', true);

//    $this->setValidators(array(
//      'name'    => new sfValidatorString(array('required' => false)),
//      'email'   => new sfValidatorEmail(),
//      'password'    => new sfValidatorString(array('required' => false)),
//      'age'    => new sfValidatorString(array('required' => false)),
//      'gender' => new sfValidatorChoice(array('choices' => array_keys(self::$display_sexs))),
//      'introduction' => new sfValidatorString(array('min_length' => 4)),
//    ));      
  }
    
}
 
?>
