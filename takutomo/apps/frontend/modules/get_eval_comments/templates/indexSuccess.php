<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
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
  	  #評価星作成
  	  $evaluate_max_number = sfConfig::get('sf_evaluate_max_number');
  	  $evaluate = $value['eval_point'];
  	  if($evaluate > $evaluate_max_number)$evaluate = $evaluate_max_number;
  	  $evaluateChar ;
  	  for($i =0;$i<$evaluate;$i++){
  	  	$evaluateChar .="☆";
  	  }
  	echo "評価:{$evaluateChar}<br />";
    #echo "(良い:{$value['eval_good']}　悪い:{$value['eval_bad']})";
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