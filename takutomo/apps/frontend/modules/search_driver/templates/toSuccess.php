<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span sytle="font-size:small;">目的地設定</span>
</div>
<?php echo $form->renderGlobalErrors() ?>
駅名か住所で入力<br />
(例)新宿駅<br />
(例)六本木6<br />
<!--<form action="<?php echo url_for('search_driver/to') ?>" method="POST">-->
<form action="?guid=ON" method="POST">
<input type="text" name="to_address" value="" />
<?php echo $form->renderHiddenFields() ?>
<input name="url" type="hidden" value="<?php echo sfConfig::get('sf_mixi_search_driver_url') .'/to/' ?>" />
<input type="submit" name="departure" value="進む"/><br />
</form>
<hr />
GPSで現在位置を入力<br />
<a href="location:gps?guid=ON&amp;url=<?php echo sfConfig::get('sf_mixi_search_driver_url').'/to/'?>">GPSで現在位置を補足</a>