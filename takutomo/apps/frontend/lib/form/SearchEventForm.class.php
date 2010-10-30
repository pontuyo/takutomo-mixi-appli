<?php
/*
 * Created on 2010/04/13
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class SearchEventForm extends sfForm
 {
 	public static $years = array();
 	
 	public function configure()
    {   
      $now = strtotime('now');
      self::$years = range(date('Y',$now),2015);
      $sfWidegetFormDate = new sfWidgetFormDate(
        array('format'=>'%year%年%month%月%day%日',
              'years' => array_combine(self::$years, self::$years),
              'can_be_empty' => false,
              //'empty_values' => array('year' => date('Y'), 'month' => sprintf('%02d',date('n')), 'day' => date('j'))
               )
       );

      $dateFormat = array('format'=>'%year%年%month%月%day%日<br />',
        'years' => array_combine(self::$years, self::$years),
        'can_be_empty' => false);
      
      $timeFormat = array('can_be_empty' => false);
      $min = array('00' => '00', '15'=>15, '30'=>30, '45'=>45);
      //$min = array(0, 15, 30, 45);
                
      $this->setWidgets(array(
      'from_address' => new sfWidgetFormInputText(),
      'from_lat' => new sfWidgetFormInputHidden(),
      'from_lon' => new sfWidgetFormInputHidden(),
      'to_address' => new sfWidgetFormInputText(),
      'to_lat' => new sfWidgetFormInputHidden(),
      'to_lon' => new sfWidgetFormInputHidden(),
      'depart_date' => $sfWidegetFormDate,
      'depart_time' => new sfWidgetFormTime(
        array('can_be_empty'=>false,'minutes' => $min)
       ),
//      'depart_time' => new sfWidgetFormDateRange(array(
//         'from_date' => new sfWidgetFormDateTime(array('date' => $dateFormat,'time' => $timeFormat)),
//         'to_date'   => new sfWidgetFormDateTime(array('date' => $dateFormat,'time' => $timeFormat)),
//         'template'  => '開始範囲<br /> %from_date%<br />終了範囲<br /> %to_date%',
//        ))
      
      
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
       //'depart_time' => '相乗り出発日'
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
      'depart_date' => new sfValidatorDate(array(),
                  array('required' => '日付を選択してください。')),
      'depart_time' => new sfValidatorTime(array(),
                  array('required' => '時刻を選択してください。'))
      
       )
    
      );
    $this->validatorSchema->setOption('allow_extra_fields', true);
     
  }
    
}
 
?>
