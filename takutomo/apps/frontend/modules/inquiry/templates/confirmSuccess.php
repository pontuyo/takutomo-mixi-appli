<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span sytle="font-size:small;">お問い合わせ</span>
</div>
以下の内容で送信します。<br />
<br />
<?= nl2br($sf_params->get('message')) ?><br />
<br />

<form action="?guid=ON" method="POST">
<?php echo $form->renderHiddenFields() ?>
<input name="url" type="hidden" value="<?php echo sfConfig::get('sf_mixi_inquiry_url') ?>/submit/" />
<input type="submit" value="送信"/>
</form>
<form action="?guid=ON" method="POST">
<?php echo $form->renderHiddenFields() ?>
<input id="adjustment" type="hidden" name="adjustment" value="1">
<input name="url" type="hidden" value="<?php echo sfConfig::get('sf_mixi_inquiry_url') ?>" />
<input type="submit" value="修正"/>
</form>


