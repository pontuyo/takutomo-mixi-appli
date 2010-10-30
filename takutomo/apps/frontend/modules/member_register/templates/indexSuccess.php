<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span sytle="font-size:small;">会員登録</span>
</div>
<?php echo $form->renderGlobalErrors() ?>
 
<form action="?guid=ON" method="POST">
<?php echo $form['email']->renderLabel() ?><br />
<?php echo $form['email']->renderError() ?>
<?php echo $form['email']->render(array('istyle' => '3','mode' =>'alphabet')) ?><br />

<?php echo $form['password']->renderLabel() ?><br />
<?php echo $form['password']->renderError() ?>
<?php echo $form['password']->render(array('istyle' => '3','mode' =>'alphabet')) ?><br />

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

<?php echo $form->renderHiddenFields() ?>
<input name="url" type="hidden" value="<?php echo sfConfig::get('sf_mixi_member_register_url') ?>" />
<input type="submit" value="確認"/>
</form>
