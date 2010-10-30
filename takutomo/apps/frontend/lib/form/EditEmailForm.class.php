<?php
/*
 * Created on 2010/04/04
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class EditEmailForm extends sfForm
 {
 	
 	public function configure()
    {   
      $this->setWidgets(array(
      'new_email' => new sfWidgetFormInputText(),
      'new_password' => new sfWidgetFormInputText(),
      ));
      
      $this->widgetSchema->setLabels(array(
       'new_email'    => '新しいメールアドレス',
       'new_password'   => '新しいパスワード'
        ));  
        
     $this->setValidators(array(
       'new_email'=> new sfValidatorAnd(
          array(
                   new sfValidatorString(),
                   new sfValidatorEmail(),
          ),
          array(),
          array('required'=>'メールアドレスを入力してください。',
                'invalid' => 'メールアドレスが不正です。')
       ),
       'new_password' => new sfValidatorString(array(),
                  array('required' => 'パスワードを入力してください。')
 
                   )
     )
    );
    $this->validatorSchema->setOption('allow_extra_fields', true);
     
  }
    
}
 
?>
