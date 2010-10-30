<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span sytle="font-size:small;">ﾀｸﾄﾓ退会</span>
</div>
退会した後は再度同じユーザーが登録することはできません。<br />
<form action="?guid=ON" method="POST">
<input name="url" type="hidden" value="<?php echo sfConfig::get('sf_mixi_delete_user_url') ?>" />
<input type="submit" value="退会"/>
</form>
