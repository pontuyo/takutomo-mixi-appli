<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span sytle="font-size:small;">出発地確認</span>
</div>
<?php  echo $display_address?>
<br />
この場所で良いですか?<br />
<?php 
 $url = sfConfig::get('sf_mixi_search_driver_url').
"/fromSubmit/?address={$sf_params->get('address')}". 
urlencode("&lon=") . $sf_params->get('lon') .
urlencode("&lat=") . $sf_params->get('lat');
?>
<a href="?guid=ON&url=<?php echo $url?>">はい,選択します。</a>
<br />
<hr />
この場所でない時は、携帯の←(戻る)ﾎﾞﾀﾝで戻って下さい。