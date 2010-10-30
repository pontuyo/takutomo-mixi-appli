<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span sytle="font-size:small;">相乗り募集リスト</span>
</div>
<?php 
$total = 0;
$view_limit = 5;
$page = (int)$sf_params->get('p');
if(empty($page))$page = 1;
//全件カウント
foreach($list as $value){
  if($value['event_id'])$total++;
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


echo "{$view_number}〜{$view_max_number}件目 /全{$total}件<br />";
echo "<hr />";

$loop = 0; 
$event_count = 0;
foreach($list as $value){
  if($value['event_id'] && ($view_number - 1) <= $event_count && $loop < ($view_limit - 1)){
    echo '<label name="name">氏名</label>&nbsp;';
    echo $value['name'];
    echo '<br />';
    echo '<label name="from">出発地</label>&nbsp;';
    echo $value['from'];
    echo '<br />';
    echo '<label name="to">目的地</label>&nbsp;';
    echo $value['to'];
    echo '<br />';  
    echo '<label name="to">出発時間</label>&nbsp;';
    echo date('Y/m/d H:i', strtotime($value['depart_time']));
    echo '<br />';
    echo '<a href="?guid=ON&url='.sfConfig::get('sf_mixi_get_profile_url').'?id='.$value['leader_m_id'].'">ﾌﾟﾛﾌｨｰﾙ</a>';
    echo '<br />' ;
    echo '<a href="?guid=ON&url='.sfConfig::get('sf_mixi_get_event_detail_url').urlencode("?event_id={$value['event_id']}&id={$value['leader_m_id']}").'">相乗り情報詳細</a>';
    echo '<br />' ;
    echo '<hr />';
    $loop++;
  }
  if($value['event_id'])$event_count++;
}
//前ページ
if($prev){
  echo '<a href="?guid=ON&url='.sfConfig::get('sf_mixi_search_event_url')."/list/?p={$prev_page}\">前の5件</a>";		
}else{
  echo '<a href="">前の5件</a>';
}
echo "&nbsp;";

//次ページ
if($next){
  echo '<a href="?guid=ON&url='.sfConfig::get('sf_mixi_search_event_url')."/list/?p={$next_page}\">次の5件</a>";	
}else{
  echo '次の5件';
}
echo '<br />'; 
echo '<a href="?guid=ON&url='.sfConfig::get('sf_mixi_search_event_url')."\">条件を変えて再検索</a>";
