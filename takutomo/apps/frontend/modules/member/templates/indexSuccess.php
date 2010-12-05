<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 1px; padding-top:2px;padding-left:2px;">
<span sytle="font-size:small;">ﾀｸｼｰ手配ﾒﾆｭｰ</span>
</div>
<img src="<?php echo sfConfig::get('sf_mixi_index_url') ?>/images/taxi.jpg" />
<a href="?guid=ON&amp;url=<?php echo sfConfig::get('sf_mixi_search_driver_url')?>">ﾀｸｼｰを呼ぶ</a>
<br />

<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span sytle="font-size:small;">相乗りﾒﾆｭｰ</span>
</div>
<img src="<?php echo sfConfig::get('sf_mixi_index_url') ?>images/ainori.gif" />
<a href="?guid=ON&amp;url=<?php echo sfConfig::get('sf_mixi_search_event_url')?>">相乗り</a>
<br />
<img src="<?php echo sfConfig::get('sf_mixi_index_url') ?>images/ainori.gif" />
<a href="?guid=ON&amp;url=<?php echo sfConfig::get('sf_mixi_member_url')?>/ainoriHistory/">相乗り履歴</a>
<br />

<?php
#相乗り募集が在るかチェック
$attend_event = false;
$now = strtotime("now");

if($get_attend_event_list['attend_event_1']['event_id'] && 
   $now <= strtotime($get_attend_event_list['attend_event_1']['depart_date'] ." ".
               $get_attend_event_list['attend_event_1']['depart_time'])) {
  $attend_event = true;
}

if($attend_event){?>
<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span sytle="font-size:small;">参加中の相乗り募集</span>
</div>
<?php 
$week = sfConfig::get('sf_date_week');
$count = 1;
$max = count($get_attend_event_list); 


foreach($get_attend_event_list as $key=>$value){
 
  if($value['event_id']  && 
   $now <= strtotime($value['depart_date'] ." ". $value['depart_time'])) 
  {
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
<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span sytle="font-size:small;">使ったら評価しよう</span>
</div>
<img src="http://pontuyo.net/takutomo/web/images/hyouka.gif" />
<a href="?guid=ON&amp;url=<?php echo sfConfig::get('sf_mixi_eval_member_url')?>">相乗り相手を評価する</a>
<br />
<img src="http://pontuyo.net/takutomo/web/images/hyouka.gif" />
<a href="?guid=ON&amp;url=<?php echo sfConfig::get('sf_mixi_eval_driver_url')?>">ﾀｸｼｰを評価する</a>
<br />


<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span sytle="font-size:small;">管理</span>
</div>
<?php echo sfJpMobile::getEmoji()->convert('&#xE719;');//鉛筆の文字?>
<a href="?guid=ON&amp;url=<?php echo sfConfig::get('sf_mixi_edit_profile_url')?>">ﾌﾟﾛﾌｨｰﾙ設定</a>
<br />

<?php //echo sfJpMobile::getEmoji()->convert('&#xE6D3;');//メールの文字?>
<!-- <a href="?guid=ON&amp;url=<?php //echo sfConfig::get('sf_mixi_edit_email_url')?>">ﾒｰﾙｱﾄﾞﾚｽ変更</a>
<br />-->
<?php echo sfJpMobile::getEmoji()->convert('&#xE6D3;');//メールの文字?>
<a href="?guid=ON&amp;url=<?php echo sfConfig::get('sf_mixi_inquiry_url')?>">お問い合わせ</a>
<!--<hr />
<a href="?guid=ON&amp;url=<?php echo sfConfig::get('sf_mixi_delete_user_url')?>">ﾀｸﾄﾓ退会</a>
-->