<?php
/*
 * Created on 2010/04/13
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 class AddEventCommentForm extends sfForm
 {
	public function configure(){
                
      $this->setWidgets(array(
      'event_id' => new sfWidgetFormInputHidden(),
      'comment' => new sfWidgetFormInputText(),
      ));
      
      $this->widgetSchema->setLabels(array(
       'comment'    => 'コメント'
        ));  
        
      $this->setValidators(
       array(
      'event_id' => new sfValidatorString(array(),
                  array('required' => 'event_idを入力してください。')),       
      'comment' => new sfValidatorString(array('min_length' => 1),
                  array('required' => 'コメントを入力してください。'))
            )
      );
      $this->validatorSchema->setOption('allow_extra_fields', true);
     
  }
    
}
 
?>
