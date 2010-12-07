<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span style="font-size:small;">相乗り検索</span>
</div>
<?php if(!is_null($addEvnetForm)){
	 echo $addEvnetForm->renderGlobalErrors();
	 echo $addEvnetForm['detail']->renderError() ;
} ?>
<div style="font-size:medium">

<form action="?guid=ON" method="POST">
<?php echo $form->renderGlobalErrors() ?>

<?php echo $form['from_address']->renderLabel() ?>
<?php echo $form['from_address']->renderError() ?>
<br />
<?php echo $from_address?>
<br />
<a href="?guid=ON&amp;url=<?php echo sfConfig::get('sf_mixi_search_event_url').'/from/' ?>">出発地設定</a>
<br />
<hr />

<?php echo $form['to_address']->renderLabel() ?>
<?php echo $form['to_address']->renderError() ?>
<br />
<?php echo $to_address?>
<br />
<a href="?guid=ON&amp;url=<?php echo sfConfig::get('sf_mixi_search_event_url').'/to/' ?>">目的地設定</a>
<br />
<hr />

<?php echo $form['depart_date']->renderLabel() ?><br />
<?php echo $form['depart_date']->renderError() ?>
<?php echo $form['depart_date']->render() ?><br />

<?php echo $form['depart_time']->renderLabel() ?>
<br />
<?php echo $form['depart_time']->renderError() ?>
<?php echo $form['depart_time']->render() ?><br />
<br />
<textarea name="detail" cols="20" rows="5"><?php echo $sf_params->get('detail')?></textarea>
<br />

<?php echo $form->renderHiddenFields() ?>
<input type="hidden" name="from_address" value="<?php echo $from_address?>" />
<input type="hidden" name="to_address" value="<?php echo $to_address?>" />
<input name="url" type="hidden" value="<?php echo sfConfig::get('sf_mixi_search_event_url').'/list/' ?>" />
<input type="submit" value="相乗りする"/>
</form>
</div>