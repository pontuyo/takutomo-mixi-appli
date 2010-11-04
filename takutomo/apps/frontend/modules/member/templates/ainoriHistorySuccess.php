<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 1px; padding-top:2px;padding-left:2px;">
<span sytle="font-size:small;">相乗り履歴</span>
</div>
<?php
#相乗り募集が在るかチェック
$attend_event = false;
$now = strtotime("now");

if($get_attend_event_list['attend_event_1']['event_id']) {
  $attend_event = true;
}

if($attend_event){
$week = sfConfig::get('sf_date_week');
$count = 1;
$max = count($get_attend_event_list); 

  foreach($get_attend_event_list as $key=>$value){
 
    if($value['event_id']){
  	  echo '<div>';
  	  echo "\n";
  	  echo '<sapn style="font-size:small;">';
  	  echo "\n";
/*    echo '<label name="event_id">相乗り案件番号</label>&nbsp;';
    echo $value['event_id'];
    echo '<br />';
    echo "\n";
    echo '<label name="leader_m_id">募集者の会員番号</label>&nbsp;';
    echo $value['leader_m_id'];
    echo '<br />';
    echo "\n";*/
//    echo '<label name="name">募集者の名前</label>&nbsp;';
//    echo $value['name'];
//    echo '<br />';  
       echo "\n";
//    echo '<label name="depart_date">出発日</label>&nbsp;';
      $depart_date = strtotime($value['depart_date']);
      echo date('m/d', $depart_date).'('. $week[date('w',$depart_date)] .') '.date('H:i', strtotime($value['depart_time'])) .'発';
      echo '<br />';  
      echo "\n";
      echo $value['from'] .'→'.$value['to'];
      echo '<br />';  
      echo "\n";
/*    echo '<label name="attend_m_id">相乗りに参加している会員の会員番号</label><br />';
    echo $value['attend_m_id'];
    echo '<br />';  
    echo "\n";
    echo '<label name="attend_name">相乗りに参加している会員名</label><br />';
    echo $value['attend_name'];
    echo '<br />';  
    echo "\n";
    echo '<label name="to_be_evaluated_id">まだ評価していない参加者の会員番号</label><br />';
    echo $value['to_be_evaluated_id'];
    echo '<br />';
    echo "\n";*/
      $url = urlencode(sfConfig::get('sf_mixi_get_event_detail_url') . '?event_id='.$value['event_id'] .'&leader_m_id='.$value['leader_m_id']);
      echo '<a href="?guid=ON&amp;url=' . $url .'">詳細</a>';
      echo '<br />';  
      echo "\n";    
      echo '</sapn>';
      echo "\n";
      echo '</div>';
  	  echo "\n";  	
  	  if ($max != $count) {
        echo '<img src="' . sfConfig::get('sf_mixi_index_url') . 'images/lines.gif" />';
      }
  	
    }
    $count++;
  }
}
  //echo '<a href="device:gpsone?guid=ON&url=http://pontuyo.net/takutomo/web/search_driver&amp;ver=1&amp;datum=0&amp;unit=1">タクシー検索</a>';
?>
<hr>
<div style="font-size:small;">
<?php 
echo sfJpMobile::getEmoji()->convert('&#xE6EA;');//9の文字
echo '<a href="?guid=ON&url='.sfConfig::get('sf_mixi_member_url').'" accesskey="9">ﾀｸﾄﾓﾒﾆｭｰ</a>'
?>
</div>
