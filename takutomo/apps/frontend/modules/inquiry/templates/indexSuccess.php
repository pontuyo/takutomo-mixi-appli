<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 1px; padding-top:2px;padding-left:2px;">
<span sytle="font-size:small;">お問い合わせ</span>
</div>
<?php echo $form->renderGlobalErrors() ?>
 
<form action="?guid=ON" method="POST">
内容<br />
<?php echo $form['message']->renderError() ?>
<?php echo $form['message']->render() ?><br />
<?php echo $form->renderHiddenFields() ?>
<input name="url" type="hidden" value="<?php echo sfConfig::get('sf_mixi_inquiry_url') ?>" />
<input type="submit" value="確認"/>
</form>
