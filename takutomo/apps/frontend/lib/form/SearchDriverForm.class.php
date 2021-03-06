<?php
/*
 * Created on 2010/04/13
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class SearchDriverForm extends sfForm
 {
 	protected static $display_categories = array(""=>"選択してください",'全て','高級車','運賃格安','安心大手','大型車');
 	public static $categories = array('全て','高級車','運賃格安','安心大手','大型車');
 	public static $years = array();
 	public function configure()
    { 
      $year = (int)date('Y');
      self::$years = range($year,$year + 1);
      $sfWidegetFormDate = new sfWidgetFormDate(
        array('format'=>'%year%年<br>%month%月%day%日',
              'years' => array_combine(self::$years, self::$years),
              'can_be_empty' => false,
              //'empty_values' => array('year' => date('Y'), 'month' => sprintf('%02d',date('n')), 'day' => date('j'))
               )
       );
       $min = array('00' => '00', '15'=>15, '30'=>30, '45'=>45);
       //$sfWidegetFormDate->render('start_date', array('year' => date('Y'), 'month' => date('n'), 'day' => date('j')));
      $sfWidegetFormDate->render('date');
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
      'category' =>new sfWidgetFormChoice(
                  array('choices' => self::$categories))
      
      
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
       'category'   => 'ﾀｸｼｰ選択'
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
                  array('required' => '時刻を選択してください。')),
      'category' => new sfValidatorChoice(array('choices' => array_keys(self::$categories)),
             array('required' =>'ﾀｸｼｰを選択してください。'))
                  
       )
    
      );
    $this->validatorSchema->setOption('allow_extra_fields', true);
     
  }
    
}
 
?>
