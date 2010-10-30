<?php echo $form->renderGlobalErrors() ?>
相乗りに参加、キャンセルする<br />
<form action="<?php echo url_for('add_event_comment/index') ?>" method="POST">

<?php echo $form['comment']->renderLabel() ?><br />
<?php echo $form['comment']->renderError() ?>
<?php echo $form['comment']->render() ?><br />

<?php echo $form->renderHiddenFields() ?>
<input type="submit" />
</form>