<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span style="font-size:small;">ﾀｸｼｰﾘｽﾄ</span>
</div>
<?php
$total = 0;
$view_limit = 5;
$page = (int)$sf_params->get('p');
if(empty($page))$page = 1;
//全件カウント
foreach($list as $value){
  if($value['driver_id'])$total++;
}
//ゼロディバイド
if($total ==0)$total = 1;

$max_page = (int)$total/$view_limit;
$next_page = $page + 1;
$prev_page = $page - 1;
$next = true;
$prev = true;

$view_max_number = $page * $view_limit;
$view_number = 1;
//件数チェック
if($page > 1){
  $view_number = $view_number + (($page - 1) * $view_limit);	
}else{
  $prev = false;
}

//最終ページチェック
if($view_max_number >= $total){
  $view_max_number = $total;
  $next = false;
}
$depart_date = $sf_params->get('depart_date');
$depart_time = $sf_params->get('depart_time');
$week = sfConfig::get('sf_date_week');
$day_name = $week[date('w',strtotime("{$depart_date['year']}/{$depart_date['month']}/{$depart_date['day']}"))];
$minute = sprintf('%02d',$depart_time['minute']);
//検索条件表示
echo "{$depart_date['month']}/{$depart_date['day']}({$day_name})&nbsp; {$depart_time['hour']}:{$minute}";
echo "<br />";
echo "{$sf_params->get('from_address')}>{$sf_params->get('to_address')}";
echo "<hr />";
echo "{$view_number}〜{$view_max_number}件目 /全{$total}件<br />";
echo "<hr />";

$loop = 0; 
$driver_count = 0;

//タクシー表示
foreach($list as $value){

  if($value['driver_id'] && ($view_number - 1) <= $driver_count && $loop <= ($view_limit - 1)){
  	if($value['recomended'] == 1){
      echo sfJpMobile::getEmoji()->convert('&#xE727;');//指でOK;
      echo '<span style="color:red">ｵｽｽﾒ</span><br />';
  	}
  	if(!empty($value['pic1_url'])){
  	  echo '<img src="'.$value['pic1_url'].'" width="60" height="60" alt="写真"  align="left" style="float:left;margin:3px;" "/>';
  	}
    echo '<label name="fare">概算運賃</label>&nbsp;';
    echo number_format($value['fare']);
    echo '円<br />';
    echo $value['name'];
    echo '<br />';
    echo '<span style="font-size:xx-small;">'.mb_convert_kana($value['car'], "k")."</span>";
    echo '<br />';
    echo '<label name="distance">乗客からの距離</label>&nbsp;';
    echo $value['distance'];
    echo 'km<br />';
    echo '<a href="?guid=ON&url='.sfConfig::get('sf_mixi_reserve_driver_url').'?driver_id='.$value['driver_id'].'">予約する</a>';
    echo "&nbsp;";
    echo '<a href="?guid=ON&url='.sfConfig::get('sf_mixi_get_profile_url').'?id='.$value['driver_id'].'">ﾌﾟﾛﾌｨｰﾙ</a>';
    echo "&nbsp;";
    echo '<a href="?guid=ON&url='.sfConfig::get('sf_mixi_get_eval_comments_url').urlencode('?id='.$value['driver_id'].'&m_id='. $value['driver_id']).'">評価</a>';
    echo '<br clear="all" />';
    echo '<hr />';
    $loop++;
  }
  if($value['driver_id'])$driver_count++;
}

//前ページ
if($prev){
  echo '<a href="?guid=ON&url='.sfConfig::get('sf_mixi_search_driver_url')."/list/?p={$prev_page}\">前の5件</a>";		
}else{
  echo '<a href="">前の5件</a>';
}
echo "&nbsp;";

//次ページ
if($next){
  echo '<a href="?guid=ON&url='.sfConfig::get('sf_mixi_search_driver_url')."/list/?p={$next_page}\">次の5件</a>";	
}else{
  echo '次の5件';
}
echo '<br />'; 
echo '<a href="?guid=ON&url='.sfConfig::get('sf_mixi_search_driver_url')."\">条件を変えて再検索</a>";
 