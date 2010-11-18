<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span style="font-size:small;">ﾀｸｼｰﾘｽﾄ</span>
</div>
<?php
use_helper('getEval');

$total = $list['summary']['num_of_result'];
//一画面最大表示件数
$view_limit = 5;
$page = (int)$sf_params->get('p');
if(empty($page))$page = 1;
//ゼロディバイド
//if($total ==0)$total = 1;

//$max_page = (int)$total/$view_limit;
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
if($total > 0)
  echo "{$view_number}〜{$view_max_number}件目 /全{$total}件<br />";
else
  echo "全{$total}件<br />";
echo "<hr />";
echo "\n";

$loop = 0; 
$driver_count = 0;
 //タクシー表示
if(!empty($list))
{
foreach($list as $value){
  //ドライバーカウントが表示件数の値以上かつ最大表示件数以下の時に処理
  if($value['driver_id'] && ($view_number - 1) <= $driver_count && $loop <= ($view_limit - 1)){
  	if($value['recomended'] == 1){
      echo sfJpMobile::getEmoji()->convert('&#xE727;');//指でOK;
      echo '<span style="color:red">ｵｽｽﾒ</span><br />';
  	}
  	if(!empty($value['pic1_url'])){
  	  echo '<img src="'.$value['pic1_url'].'" width="100" height="100" alt="写真"  align="left" style="float:left;margin:3px;" "/>';
  	}else{
  	  echo '<img src="'.sfConfig::get('sf_mixi_index_url').'/images/noimage.jpg" width="100" height="100" alt="写真"  align="left" style="float:left;margin:3px;" "/>';
  	}
  	echo '<span style="font-size:xx-small;"><font size="1">';
    echo '概算運賃<br />';
    echo number_format($value['fare']);
    echo '円<br />';
    echo $value['name'];
    echo '<br />';
    echo mb_convert_kana($value['car'], "k");
    echo '<br />';
    echo '乗客からの距離&nbsp;<br />';
    echo $value['distance'];
    echo 'km';
    echo '<br /><div clear="all" style="clear:both;"></div>';
    echo '<a href="?guid=ON&url='.sfConfig::get('sf_mixi_reserve_driver_url').'?driver_id='.$value['driver_id'].'">予約</a>';
    echo "&nbsp;";
    echo '<a href="?guid=ON&url='.sfConfig::get('sf_mixi_get_profile_url').'?id='.$value['driver_id'].'">ﾌﾟﾛﾌｨｰﾙ</a>';
    echo "&nbsp;";
    echo '<a href="?guid=ON&url='.sfConfig::get('sf_mixi_get_eval_comments_url').urlencode('?id='.$value['driver_id'].'&m_id='. $value['driver_id']).'">評価</a>';
    echo getEval($value['driver_id']);
    echo '</font></span>';
    echo '<hr />';
    echo "\n";
    $loop++;
  }
  //何ページのドライバーを探すため
  if($value['driver_id'])$driver_count++;
  //表示件数を上回ったらブイレク
  if($loop > ($view_limit - 1))break;
  
}
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
 