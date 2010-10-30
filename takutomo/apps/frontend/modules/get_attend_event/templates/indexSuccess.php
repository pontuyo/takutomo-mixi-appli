<div style="text-align: left; background-color:#00ccff; color:#ffffff; margin:5px 0; padding-top:2px;">
<span sytle="font-size:small;">相乗り募集詳細</span>
</div>

<?php 
$event_exist = false;
foreach($get_attend_event_list as $key=>$value){
  if($value['event_id'] && $value['event_id'] == $sf_request->getParameter('event_id')){
  	echo '<div>';
  	echo "\n";
  	echo '<sapn style="font-size:small;">';
  	echo "\n";
#    echo '<label name="event_id">相乗り案件番号</label>&nbsp;';
#    echo $value['event_id'];
#    echo '<br />';
#    echo "\n";
#    echo '<label name="leader_m_id">募集者の会員番号</label>&nbsp;';
#    echo $value['leader_m_id'];
#    echo '<br />';
#    echo "\n";
    echo '<label name="name">募集者の名前</label>&nbsp;';
    echo $value['name'];
    echo '<br />';  
     echo "\n";
    echo '<label name="depart_date">出発日</label>&nbsp;';
    echo date('Y/m/d', strtotime($value['depart_date'])).' '.date('H:i', strtotime($value['depart_time']));
    echo '<br />';  
    echo "\n";
    echo '<label name="from">出発地の住所</label><br />';
    echo $value['from'];
    echo '<br />';  
    echo "\n";
    echo '<label name="to">目的地の住所</label><br />';
    echo $value['to'];
    echo '<br />';  
    echo "\n";
    echo '<label name="attend_m_id">相乗りに参加している会員の会員番号</label><br />';
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
    echo "\n";
    echo "\n";    
    echo '</sapn>';
     echo "\n";
    echo '</div>';
  	echo "\n";  
  	
  	$event_exist = true;
  }
}

if(!$event_exist)
  echo 'イベントが存在しません。';

 
?>
<br />
<a href="?guid=ON&url=<?php echo sfConfig::get('sf_mixi_member_url') ?>">戻る</a>
