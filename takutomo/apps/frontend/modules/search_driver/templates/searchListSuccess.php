<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span sytle="font-size:small;">候補値選択</span>
</div>
<?php use_helper('geocodeParser');?> 
<?php foreach($list['Response']['Placemark'] as $value){

  $result = geocodeParser($value);
  if($result['address'] != ""){
    $url = sfConfig::get('sf_mixi_search_driver_url').
    "/$module_name/?address=".$result['address'].urlencode("&lon=").$result['lon'].urlencode("&lat=").$result['lat'];
  
    echo "<a href=\"?guid=ON&url={$url}\">{$result['address']}</a>";
    echo "<br />";
    echo "\n" ;
  	
  }
}
?>
