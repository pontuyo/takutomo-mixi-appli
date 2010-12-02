<?php
/*
 * Created on 2010/04/04
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class MemberForm extends sfForm
 {
 	protected static $display_sexs = array(""=>"選択してください",'男','女');
 	public static $sexs = array('男','女');
 	
 	public function configure()
    {   
      $this->setWidgets(array(
      'email' => new sfWidgetFormInputText(),
      'password' => new sfWidgetFormInputText(),
      'name' => new sfWidgetFormInputText(),
      'age' => new sfWidgetFormInputText(),
      'gender' => new sfWidgetFormChoice(
                  array('choices' => self::$display_sexs)),
      'introduction' => new sfWidgetFormTextarea()
      ));
      //$this->widgetSchema->setNameFormat('member[%s]');
      
      $this->widgetSchema->setLabels(array(
       'email'    => 'メールアドレス',
       'password'   => 'パスワード',
       'name' => 'ﾆｯｸﾈｰﾑ',
       'age' => '年齢',
       'gender' => '性別',
       'introduction' => '自己紹介'
        ));  
        
     $this->setValidators(array(
//mixiアプリガイドライン対応 取得が禁止されている
//       'email'=> new sfValidatorAnd(
//          array(
//                   new sfValidatorString(array('required' => false)),
//                   new sfValidatorEmail(array('required' => false)),
//          ),
//          array(),
//          array('required'=>'メールアドレスを入力してください。',
//                'invalid' => 'メールアドレスが不正です。')
//       ),
       'email' => new sfValidatorString(array('required' => false),
                  array('required' => 'メールアドレスを入力してください。')),

       'password' => new sfValidatorString(array('required' => false),
                  array('required' => 'パスワードを入力してください。')),
       'name' => new sfValidatorString(
                array('required' => true),
                array('required' => '名前を入力してください。','invalid' => '年齢が不正です。')),
       'age' => new sfValidatorAnd(
          array(
                   new sfValidatorString(),
                   new sfValidatorInteger(),
          ),
          array(),
          array('required'=>'年齢を入力してください。',
                'invalid' => '年齢が不正です。')
       ),
 
       'gender' => new sfValidatorChoice(array('choices' => array_keys(self::$sexs)),
             array('required' =>'性別を選択してください。')  
       ),
       'introduction' => new sfValidatorString(array('required' => false)),
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
