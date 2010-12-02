<?php
/*
 * Created on 2010/04/04
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class ProfileForm extends sfForm
 {
 	protected static $display_sexs = array(""=>"選択してください",'男','女');
 	public static $sexs = array('男','女');
 	
 	public function configure()
    {   
      $this->setWidgets(array(
      'name' => new sfWidgetFormInputText(),
      'age' => new sfWidgetFormInputText(),
      'gender' => new sfWidgetFormChoice(
                  array('choices' => self::$display_sexs)),
      'introduction' => new sfWidgetFormTextarea(),
      'from1' => new sfWidgetFormInputText(),
      'from2' => new sfWidgetFormInputText(),
      'from3' => new sfWidgetFormInputText(),
      'from4' => new sfWidgetFormInputText(),
      'from5' => new sfWidgetFormInputText(),
      'from1_lat' => new sfWidgetFormInputText(),
      'from2_lat' => new sfWidgetFormInputText(),
      'from3_lat' => new sfWidgetFormInputText(),
      'from4_lat' => new sfWidgetFormInputText(),
      'from5_lat' => new sfWidgetFormInputText(),
      'from1_lon' => new sfWidgetFormInputText(),
      'from2_lon' => new sfWidgetFormInputText(),
      'from3_lon' => new sfWidgetFormInputText(),
      'from4_lon' => new sfWidgetFormInputText(),
      'from5_lon' => new sfWidgetFormInputText(),
      'to1' => new sfWidgetFormInputText(),
      'to2' => new sfWidgetFormInputText(),
      'to3' => new sfWidgetFormInputText(),
      'to4' => new sfWidgetFormInputText(),
      'to5' => new sfWidgetFormInputText(),
      'to1_lat' => new sfWidgetFormInputText(),
      'to2_lat' => new sfWidgetFormInputText(),
      'to3_lat' => new sfWidgetFormInputText(),
      'to4_lat' => new sfWidgetFormInputText(),
      'to5_lat' => new sfWidgetFormInputText(),
      'to1_lon' => new sfWidgetFormInputText(),
      'to2_lon' => new sfWidgetFormInputText(),
      'to3_lon' => new sfWidgetFormInputText(),
      'to4_lon' => new sfWidgetFormInputText(),
      'to5_lon' => new sfWidgetFormInputText(),      
      
      
      ));
      //$this->widgetSchema->setNameFormat('member[%s]');
      
      $this->widgetSchema->setLabels(array(
       'name' => 'ﾆｯｸﾈｰﾑ',
       'age' => '年齢',
       'gender' => '性別',
       'introduction' => '自己紹介',
       'from1' => '出発地1',
       'from2' => '出発地2',
       'from3' => '出発地3',
       'from4' => '出発地4',
       'from5' => '出発地5',
       'to1' => '目的地1',
       'to2' => '目的地2',
       'to3' => '目的地3',
       'to4' => '目的地4',
       'to5' => '目的地5',       
        ));  
        
     $this->setValidators(array(

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
       'from1' => new sfValidatorString(array('required' => false)),
       'from2' => new sfValidatorString(array('required' => false)),
       'from3' => new sfValidatorString(array('required' => false)),
       'from4' => new sfValidatorString(array('required' => false)),
       'from5' => new sfValidatorString(array('required' => false)),
       'from1_lat' => new sfValidatorString(array('required' => false)),
       'from2_lat' => new sfValidatorString(array('required' => false)),
       'from3_lat' => new sfValidatorString(array('required' => false)),
       'from4_lat' => new sfValidatorString(array('required' => false)),
       'from5_lat' => new sfValidatorString(array('required' => false)),       
       'from1_lon' => new sfValidatorString(array('required' => false)),
       'from2_lon' => new sfValidatorString(array('required' => false)),
       'from3_lon' => new sfValidatorString(array('required' => false)),
       'from4_lon' => new sfValidatorString(array('required' => false)),
       'from5_lon' => new sfValidatorString(array('required' => false)),
       'to1' => new sfValidatorString(array('required' => false)),
       'to2' => new sfValidatorString(array('required' => false)),
       'to3' => new sfValidatorString(array('required' => false)),
       'to4' => new sfValidatorString(array('required' => false)),
       'to5' => new sfValidatorString(array('required' => false)),
       'to1_lat' => new sfValidatorString(array('required' => false)),
       'to2_lat' => new sfValidatorString(array('required' => false)),
       'to3_lat' => new sfValidatorString(array('required' => false)),
       'to4_lat' => new sfValidatorString(array('required' => false)),
       'to5_lat' => new sfValidatorString(array('required' => false)),       
       'to1_lon' => new sfValidatorString(array('required' => false)),
       'to2_lon' => new sfValidatorString(array('required' => false)),
       'to3_lon' => new sfValidatorString(array('required' => false)),
       'to4_lon' => new sfValidatorString(array('required' => false)),
       'to5_lon' => new sfValidatorString(array('required' => false))
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
