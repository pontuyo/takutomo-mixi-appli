<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span sytle="font-size:small;">ﾒｰﾙ受信設定</span>
</div>
<?php echo $form->renderGlobalErrors() ?>

 
<form action="?guid=ON" method="POST">
<?php echo $form['new_email']->renderLabel() ?><br />
<?php echo $form['new_email']->renderError() ?>
<?php echo $form['new_email']->render(array('istyle' => '3','mode' =>'alphabet')) ?><br />
<?php echo $form['new_password']->renderLabel() ?><br />
<?php echo $form['new_password']->renderError() ?>
<?php echo $form['new_password']->render(array('istyle' => '3','mode' =>'alphabet')) ?><br />

<?php echo $form->renderHiddenFields() ?>
<input name="url" type="hidden" value="<?php echo sfConfig::get('sf_mixi_edit_email_url') .'/confirm/' ?>" />
<input type="submit" value="確認メール送信"/>
</form>
