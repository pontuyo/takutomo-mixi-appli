<?php
/*
 * Created on 2010/11/5
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class InquiryForm extends sfForm
 {
 	public static $years = array();
 	
 	public function configure()
    {   
      $this->setWidgets(array(
      'message' =>new sfWidgetFormTextarea()
      
      ));
      
      
      $this->widgetSchema->setLabels(array(
       'message'   => 'お問い合わせ内容'
        ));  
        
     $this->setValidators(
       array(
      'message' => new sfValidatorString(array(),
                  array('required' => 'お問い合わせ内容を入力してください。'))
                  
       )
    
      );
    $this->validatorSchema->setOption('allow_extra_fields', true);
     
  }
    
}
 
?>
