<div style="text-align: left; background-color:#00ccff; color:#000000; margin:5px 0; padding-top:2px;">
<span style="font-size:small;">評価</span>
</div>
<?php
foreach($member as $value){
  if($value['m_id']){
  	echo "{$value['name']}さん<br />";
  	echo "<hr />";
  }
}

foreach($comments as $value){
  
  if($value['eval_point']){
  	echo "評価:{$value['eval_point']}<br />";
    echo "(良い:{$value['eval_good']}　悪い:{$value['eval_bad']})";
    echo "<hr />";
  }
  
  if($value['eval_date']){
  	$year = substr($value['eval_date'],0,4);
  	$month = substr($value['eval_date'],4,2);
  	$day = substr($value['eval_date'],6,2);
  	$hour = substr($value['eval_date'],8,2);
  	$min = substr($value['eval_date'],10,2);
  	$week = sfConfig::get('sf_date_week');
    $day_name = $week[date('w',strtotime("{$year}/{$month}/{$day}"))];
  	
  	echo "日時：{$month}/{$day}({$day_name}) {$hour}:{$min}<br />";
  	echo "評価：{$value['eval_rank']}<br />";
  	echo "評価者：{$value['eval_by_name']}<br />";
  	echo "ｺﾒﾝﾄ：{$value['eval_comment']}<br />";
    echo "<hr />"; 
  } 
}
echo '携帯の←（戻る）ボタンを押して戻って下さい。';