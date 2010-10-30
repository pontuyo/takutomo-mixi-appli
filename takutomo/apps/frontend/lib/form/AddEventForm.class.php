<?php
/*
 * Created on 2010/04/13
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class AddEventForm extends sfForm
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
       //$sfWidegetFormDate->render('start_date', array('year' => date('Y'), 'month' => date('n'), 'day' => date('j')));
      $sfWidegetFormDate->render('date');
      $this->setWidgets(array(
      'from_address' => new sfWidgetFormInputText(),
      'from_lat' => new sfWidgetFormInputText(),
      'from_lon' => new sfWidgetFormInputText(),
      'to_address' => new sfWidgetFormInputText(),
      'to_lat' => new sfWidgetFormInputText(),
      'to_lon' => new sfWidgetFormInputText(),
      'add_event_depart_date' => $sfWidegetFormDate,
      'add_event_depart_time' => new sfWidgetFormTime(),
      'detail' =>new sfWidgetFormTextarea()
      
      ));
      
      
      $this->widgetSchema->setLabels(array(
       'from_address'    => '出発地',
       'from_lat'    => '出発地の緯度',
       'from_lon'   => '出発地の経度',
       'to_address'    => '目的地',
       'to_lat'    => '目的地の緯度',
       'to_lon'   => '目的地の経度',
       'add_event_depart_date'    => '出発日',
       'add_event_depart_time'   => '出発時刻',
       'detail'   => '詳細'
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
      'add_event_depart_date' => new sfValidatorDate(array(),
                  array('required' => '日付を選択してください。')),
      'add_event_depart_time' => new sfValidatorTime(array(),
                  array('required' => '時刻を選択してください。')),
      'detail' => new sfValidatorString(array(),
                  array('required' => '詳細を入力してください。'))
                  
       )
    
      );
    $this->validatorSchema->setOption('allow_extra_fields', true);
     
  }
    
}
 
?>
