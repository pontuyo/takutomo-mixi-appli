<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span sytle="font-size:small;">会員登録</span>
</div>
以下の内容で登録します。<br />
<br />
<form action="?guid=ON" method="POST">
<!--
メールアドレス<br />
<?= $sf_params->get('email') ?><br />
-->
ﾆｯｸﾈｰﾑ<br />
<?= $sf_params->get('name') ?><br />

年齢<br />
<?= $sf_params->get('age') ?><br />
性別<br />
<?php echo $display_gender ?><br />
自己紹介<br />
<?= $sf_params->get('introduction') ?><br />
<br />

<?php echo $form->renderHiddenFields() ?>
<input name="url" type="hidden" value="<?php echo sfConfig::get('sf_mixi_member_register_url') ?>/confirm/" />
<input type="submit" value="登録"/>
</form>
<br />
<form action="?guid=ON" method="post">
<input id="gender" type="hidden" name="adjustment" value="1">
<?php echo $form->renderHiddenFields() ?>
<input name="url" type="hidden" value="<?php echo sfConfig::get('sf_mixi_member_register_url') ?>" />
<input type="submit" value="修正"/>
</form>


