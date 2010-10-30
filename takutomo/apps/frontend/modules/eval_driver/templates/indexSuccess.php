<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span style="font-size:small;">ﾀｸｼｰ評価</span>
</div>
<?php
$week = sfConfig::get('sf_date_week');
$totalCount = 0;
$count = 0;
foreach($list as $value){
  if($value['driver_id'])
    $totalCount++;
}

foreach($list as $value)
{
  if($value['driver_id'])
  {
  	if($count > 0)
  	  echo "<hr />";
  	$year = substr($value['depart_date'],0,4);
  	$month = substr($value['depart_date'],4,2);
  	$day = substr($value['depart_date'],6,2);
  	$day_name = $week[date('w',strtotime("{$year}/{$month}/{$day}"))];
  	$hour = substr($value['depart_time'],0,2);
  	$min = substr($value['depart_time'],2,2);
  	echo "{$month}/{$day}({$day_name})&nbsp; {$hour}:{$min}";
  	echo "<br />";
  	echo "{$value['from']}→{$value['to']}";
  	echo "<br />";
  	if($value['evaluated'] == 0)
  	  echo '<a href="?guid=ON&url='.sfConfig::get('sf_mixi_eval_user_url').urlencode("?request_id={$value['request_id']}&m_id={$value['driver_id']}").'">' . $value['name'] . 'さん</a>';
  	else
  	  echo $value['name'] . 'さん(評価済)';
  	$count++;
  }
}

if($totalCount <= 0)
  echo 'ﾀｸｼｰｲﾍﾞﾝﾄが存在しません。';