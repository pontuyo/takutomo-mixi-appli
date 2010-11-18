<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span style="font-size:small;">ﾀｸｼｰ検索</span>
</div>
<div style="font-size:medium">

<form action="?guid=ON" method="post">
<?php echo $form->renderGlobalErrors() ?>
<?php echo $form['from_address']->renderLabel() ?><br />
<?php echo $form['from_address']->renderError() ?>
<?php echo $from_address?>
<br />
<a href="?guid=ON&amp;url=<?php echo sfConfig::get('sf_mixi_search_driver_url').'/from/' ?>">出発地設定</a>
<br />
<hr />
<?php echo $form['to_address']->renderLabel() ?><br />
<?php echo $form['to_address']->renderError() ?>
<?php echo $to_address?>
<br />
<a href="?guid=ON&amp;url=<?php echo sfConfig::get('sf_mixi_search_driver_url').'/to/' ?>">目的地設定</a>
<br />
<hr />
<?php echo $form['depart_date']->renderLabel() ?><br />
<?php echo $form['depart_date']->renderError() ?>
<?php echo $form['depart_date']->render() ?><br />

<?php echo $form['depart_time']->renderLabel() ?>
<br />
<?php echo $form['depart_time']->renderError() ?>
<?php echo $form['depart_time']->render() ?><br />
<hr />
<?php echo $form['category']->renderLabel() ?><br />
<?php echo $form['category']->renderError() ?>
<?php echo $form['category']->render() ?><br />

<?php echo $form->renderHiddenFields() ?>
<input type="hidden" name="from_address" value="<?php echo $from_address?>" />
<input type="hidden" name="to_address" value="<?php echo $to_address?>" />

<input name="url" type="hidden" value="<?php echo sfConfig::get('sf_mixi_search_driver_url') ?>/list/" />
<input type="submit" value="検索"/>
</form>
</div>
