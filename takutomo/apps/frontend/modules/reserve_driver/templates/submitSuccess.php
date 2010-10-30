<div style="text-align: left; background-color:#00ccff; color:#000000; margin:5px 0; padding-top:2px;">
<span sytle="font-size:small;">予約完了</span>
</div>
<?php echo $display_description ?>
<br />
<a href="tel:<?php echo $display_phone ?>"><?php echo $display_phone ?></a>
<br />
<?php 
echo '<a href="?guid=ON&url='.sfConfig::get('sf_mixi_member_url').'">タクトモ TOPへ</a>';