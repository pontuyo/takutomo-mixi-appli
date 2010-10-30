<div style="text-align: left; background-color:#00ccff; color:#000000; margin:5px 0; padding-top:2px;">
<span style="font-size:small;">評価</span>
</div>
<?php echo $form->renderGlobalErrors() ?>

<?php foreach($profile as $value){  
  if($value['m_id']){
  	echo "{$value['name']}を<br />";
  	echo "評価して下さい";
  }
}
?>
<hr />
<form action="?guid=ON" method="POST">

<input type="radio" name="eval" value="良い" checked >良い<br />
<input type="radio" name="eval" value="普通">普通<br />
<input type="radio" name="eval" value="悪い">悪い<br />
<hr />
コメント(任意)<br />
<textarea rows="4" cols="20" name="eval_comment"></textarea>
<br />
ボタンを押すとすぐに評価完了します。評価は他人に閲覧されます。変更できませんので間違いがないかよく確認下さい。<br />
あなたは相手からも評価され、他人に閲覧されます。<br />
<br />
<input type='hidden' name='m_id' value='<?php echo $sf_params->get('m_id') ?>'>
<input type='hidden' name='id' value="<?php echo $sf_params->get('m_id') ?>">
<input type='hidden' name='request_id' value="<?php echo $sf_params->get('request_id') ?>">
<input type='hidden' name='event_id' value="<?php echo $sf_params->get('event_id') ?>">
<input name="url" type="hidden" value="<?php echo sfConfig::get('sf_mixi_eval_user_url') . '/submit/' ?>" />
<input type="submit" name="departure" value="評価"/><br />
</form>