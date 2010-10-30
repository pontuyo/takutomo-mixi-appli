<?php echo $form->renderGlobalErrors() ?>
相乗り募集<br />
<form action="<?php echo url_for('add_event/index') ?>" method="POST">
<?php echo $form['from_address']->renderLabel() ?>
<input type="submit" name="departure" value="出発地設定"/><br />
<?php echo $form['from_address']->renderError() ?>
<?php echo $form['from_address']->render() ?><br />

<?php echo $form['from_lat']->renderLabel() ?><br />
<?php echo $form['from_lat']->renderError() ?>
<?php echo $form['from_lat']->render() ?><br />

<?php echo $form['from_lon']->renderLabel() ?><br />
<?php echo $form['from_lon']->renderError() ?>
<?php echo $form['from_lon']->render() ?><br />

<?php echo $form['to_address']->renderLabel() ?>
<input type="submit" name="destination" value="目的地設定"/><br />
<?php echo $form['to_address']->renderError() ?>
<?php echo $form['to_address']->render() ?><br />

<?php echo $form['to_lat']->renderLabel() ?><br />
<?php echo $form['to_lat']->renderError() ?>
<?php echo $form['to_lat']->render() ?><br />

<?php echo $form['to_lon']->renderLabel() ?><br />
<?php echo $form['to_lon']->renderError() ?>
<?php echo $form['to_lon']->render() ?><br />

<?php echo $form['depart_date']->renderLabel() ?><br />
<?php echo $form['depart_date']->renderError() ?>
<?php echo $form['depart_date']->render() ?><br />

<?php echo $form['depart_time']->renderLabel() ?>
<?php echo $form['depart_time']->renderError() ?>
<?php echo $form['depart_time']->render() ?><br />

<?php echo $form['detail']->renderLabel() ?><br />
<?php echo $form['detail']->renderError() ?>
<?php echo $form['detail']->render() ?><br />

<?php echo $form->renderHiddenFields() ?>
<input type="submit" />
</form>