<form action="<?php echo url_for('forgot_password/index') ?>" method="POST">
<?php echo $form['email']->renderLabel() ?><br />
<?php echo $form['email']->renderError() ?>
<?php echo $form['email']->render(array('istyle' => '3')) ?><br />
<?php echo $form->renderHiddenFields() ?>
<input type="submit" value="送信する"/>
</form>