 <div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span sytle="font-size:small;">ﾒｰﾙ受信設定</span>
</div>
<?php echo $profileForm->renderGlobalErrors() ?>
 
<?php 
foreach($profile as $value)
{
  
	if($value['m_id'])
	{
	  echo '登録ﾒｰﾙｱﾄﾞﾚｽ:<br />';
	  echo $value['email'];
	  echo "<br />";
	  echo '<a href="?guid=ON&url='.sfConfig::get('sf_mixi_edit_email_url').'/confirm/ ">変更する</a>';
	}
} 
?>
