<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span sytle="font-size:small;">ﾀｸｼｰ予約</span>
</div>
<?php echo $form->renderGlobalErrors() ?>
<form action="?guid=ON" method="post">

<?php 
  $year = substr($sf_params->get('depart_date'),0,4);
  $month = substr($sf_params->get('depart_date'),4,2);
  $day = substr($sf_params->get('depart_date'),6,2);
  $hour = substr($sf_params->get('depart_time'),0,2);
  $min = substr($sf_params->get('depart_time'),2,2);
  $week = sfConfig::get('sf_date_week');
  $day_name = $week[date('w',strtotime("{$year}/{$month}/{$day}"))];

  echo $form['depart_date']->renderLabel(); 
  echo "&nbsp;{$month}/{$day}({$day_name}) {$hour}:{$min}<br />";
 ?>
 
<?php echo $form['from_address']->renderLabel() ?>
<?php echo $form['from_address']->renderError() ?>
&nbsp;<?php echo $sf_params->get('from_address') ?><br />

<?php echo $form['to_address']->renderLabel() ?>
<?php echo $form['to_address']->renderError() ?>
&nbsp;<?php echo $sf_params->get('to_address') ?><br />
運転手&nbsp;
<?php foreach($member as $value){  
  if($value['m_id']){
  	echo "{$value['name']}<br />";
  }
}
?>
<?php echo $form['phone']->renderLabel() ?><br />
<?php echo $form['phone']->renderError() ?>
<?php echo $form['phone']->render() ?><br />

<?php echo $form->renderHiddenFields() ?>
<input name="url" type="hidden" value="<?php echo sfConfig::get('sf_mixi_reserve_driver_url') ?>" />
<input type="submit" value="予約"/>
</form>