<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span sytle="font-size:small;">ﾌﾟﾛﾌｨｰﾙ変更</span>
</div>
 <?php echo $form->renderGlobalErrors() ?>
 <?php 
 foreach($profileMySelf as $value){
 	//print_r($value);
 }
 
 //print_r($profile);
 ?>
<form action="?guid=ON" method="POST">
<?php echo $form['name']->renderLabel() ?><br />
<?php echo $form['name']->renderError() ?>
<?php echo $form['name']->render() ?><br />

<?php echo $form['age']->renderLabel() ?><br />
<?php echo $form['age']->renderError() ?>
<?php echo $form['age']->render() ?><br />

<?php echo $form['gender']->renderLabel() ?><br />
<?php echo $form['gender']->renderError() ?>
<?php echo $form['gender']->render() ?><br />

<?php echo $form['introduction']->renderLabel() ?><br />
<?php echo $form['introduction']->renderError() ?>
<?php echo $form['introduction']->render() ?><br />
<br />
よくタクシーに乗ることがある出発地<br />
<?php echo $form['from1']->renderLabel() ?><br />
<?php echo $form['from1']->renderError() ?>
<?php echo $form['from1']->render() ?><br />

<?php echo $form['from2']->renderLabel() ?><br />
<?php echo $form['from2']->renderError() ?>
<?php echo $form['from2']->render() ?><br />

<?php echo $form['from3']->renderLabel() ?><br />
<?php echo $form['from3']->renderError() ?>
<?php echo $form['from3']->render() ?><br />

<?php echo $form['from4']->renderLabel() ?><br />
<?php echo $form['from4']->renderError() ?>
<?php echo $form['from4']->render() ?><br />

<?php echo $form['from5']->renderLabel() ?><br />
<?php echo $form['from5']->renderError() ?>
<?php echo $form['from5']->render() ?><br />
<br />
よくタクシーに乗ることがある目的地<br />
<?php echo $form['to1']->renderLabel() ?><br />
<?php echo $form['to1']->renderError() ?>
<?php echo $form['to1']->render() ?><br />

<?php echo $form['to2']->renderLabel() ?><br />
<?php echo $form['to2']->renderError() ?>
<?php echo $form['to2']->render() ?><br />

<?php echo $form['to3']->renderLabel() ?><br />
<?php echo $form['to3']->renderError() ?>
<?php echo $form['to3']->render() ?><br />

<?php echo $form['to4']->renderLabel() ?><br />
<?php echo $form['to4']->renderError() ?>
<?php echo $form['to4']->render() ?><br />

<?php echo $form['to5']->renderLabel() ?><br />
<?php echo $form['to5']->renderError() ?>
<?php echo $form['to5']->render() ?><br />

<?php echo $form->renderHiddenFields() ?>
<input name="url" type="hidden" value="<?php echo sfConfig::get('sf_mixi_edit_profile_url') ?>" />
<input type="submit" value="変更"/>
</form>
