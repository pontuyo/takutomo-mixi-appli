<?php
/*
 * Created on 2010/04/13
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class ReserveDriverForm extends sfForm
 {

 	public static $years = array();
 	
 	public function configure()
    {   
      self::$years = range(2010,2015);
      $sfWidegetFormDate = new sfWidgetFormDate(
        array('format'=>'%year%年%month%月%day%日',
              'years' => array_combine(self::$years, self::$years),
              'can_be_empty' => false,
              //'empty_values' => array('year' => date('Y'), 'month' => sprintf('%02d',date('n')), 'day' => date('j'))
               )
       );

      $this->setWidgets(array(
      'from_address' => new sfWidgetFormInputHidden(),
      'from_lat' => new sfWidgetFormInputHidden(),
      'from_lon' => new sfWidgetFormInputHidden(),
      'to_address' => new sfWidgetFormInputHidden(),
      'to_lat' => new sfWidgetFormInputHidden(),
      'to_lon' => new sfWidgetFormInputHidden(),
      'depart_date' => new sfWidgetFormInputHidden(),
      'depart_time' => new sfWidgetFormInputHidden(),
      'driver_m_id' => new sfWidgetFormInputHidden(),
      'phone' => new sfWidgetFormInputText()
      
      
      ));

      
      $this->widgetSchema->setLabels(array(
       'from_address'    => '出発地',
       'from_lat'    => '出発地の緯度',
       'from_lon'   => '出発地の経度',
       'to_address'    => '目的地',
       'to_lat'    => '目的地の緯度',
       'to_lon'   => '目的地の経度',
       'depart_date'    => '出発日',
       'depart_time'   => '出発時刻',
       'phone'         =>'乗客の携帯電話番号'
        ));  

     $this->setValidators(
       array(
      'from_address' => new sfValidatorString(array(),
                  array('required' => '出発地を入力してください。')),       
      'from_lat' => new sfValidatorString(array(),
                  array('required' => '出発地の緯度を入力してください。')),
      'from_lon' => new sfValidatorString(array(),
                  array('required' => '出発地の経度を入力してください。')),
      'to_address' => new sfValidatorString(array(),
                  array('required' => '目的地を入力してください。')),                  
      'to_lat' => new sfValidatorString(array(),
                  array('required' => '目的地の緯度を入力してください。')),
      'to_lon' => new sfValidatorString(array(),
                  array('required' => '目的地の経度を入力してください。')),
      'depart_date' => new sfValidatorString(array(),
                  array('required' => '日付を入力してください。')),
      'depart_time' => new sfValidatorString(array(),
                  array('required' => '時刻を入力してください。')),
      'driver_m_id' => new sfValidatorString(array(),
                  array('required' => 'dirver_idを入力してください。')),
       'phone' => new sfValidatorAnd(
          array(
                   new sfValidatorString(array('max_length' => 11,'min_length' => 11)),
                   
          ),
          array(),
          array('required'=>'電話番号を入力してください。','invalid' => '電話番号は11桁で入力してください。')
       ),
       )
      );
 
    $this->validatorSchema->setOption('allow_extra_fields', true);
     
  }
    
}
 
?>
