 <?php echo $form->renderGlobalErrors() ?>
 
<form action="<?php echo url_for('login/index') ?>" method="POST">
<?php echo $form['email']->renderRow() ?><br />
<?php echo $form['password']->renderRow() ?><br />
<?php echo $form->renderHiddenFields() ?>
<input type="submit" />
</form>
