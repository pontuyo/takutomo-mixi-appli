<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span sytle="font-size:small;">相乗り募集の詳細 </span>
</div>
<?php
$week = sfConfig::get('sf_date_week');

foreach($member as $value){
  if($value['m_id']){
    $name = $value['name'];
  }
}

foreach($event_detail as $value){
  
  if($value['leader_m_id']){
  	//print_r($value);
  	#地図表示用URL作成
  	$imgurl = sfConfig::get('sf_google_static_map_url').
  	"?size=240x240&sensor=false".
  	"&markers=color:blue|label:S|{$value['from_lat']},{$value['from_lon']}&markers=color:red|label:G|{$value['to_lat']},{$value['to_lon']}".
  	"&path=color:blue|weight:5|{$value['from_lat']},{$value['from_lon']}|{$value['to_lat']},{$value['to_lon']}";
    
    $year = substr($value['depart_time'],0,4);
    $month = substr($value['depart_time'],4,2);
    $day = substr($value['depart_time'],6,2);
    $hour = substr($value['depart_time'],8,2);
    $min = substr($value['depart_time'],10,2);
    $day_name = $week[date('w',strtotime("{$year}/{$month}/{$day}"))];  	
    
    echo "{$month}/{$day}({$day_name})&nbsp; {$hour}:{$min}";
    echo "<br />";
    echo "{$value['from']}→{$value['to']}";
    echo "<br />";
    $url = urlencode(sfConfig::get('sf_mixi_get_profile_url') . '?id='.$value['leader_m_id']);
    echo '募集者:<a href="?guid=ON&amp;url=' . $url . '">' . $name . '</a>';
    echo "<br />";
    echo $value['detail'];
    echo "<br />";
    echo '<img src="'.$imgurl.'" alt="地図"/><br />';
    echo "<br />";
  }
  if($value['comment_date']){
    $year = substr($value['comment_date'],0,4);
    $month = substr($value['comment_date'],4,2);
    $day = substr($value['comment_date'],6,2);
    $hour = substr($value['comment_date'],8,2);
    $min = substr($value['comment_date'],10,2);
    $day_name = $week[date('w',strtotime("{$year}/{$month}/{$day}"))];  	
    
    echo "日時:{$month}/{$day}({$day_name})&nbsp; {$hour}:{$min}";
    echo "<br />";
    $url = urlencode(sfConfig::get('sf_mixi_get_profile_url') . '?id='.$value['comment_by_id']);
    echo '<a href="?guid=ON&amp;url=' . $url . '">' . $value['comment_by_name'] . '</a>';
    echo "<br />";
    echo "ｺﾒﾝﾄ:".$value['comment'];
    echo "<br />";
    
  }
}
?>
<hr>
相乗り掲示板<br />
相乗り参加する場合や参加者に連絡したい場合は書き込み下さい。<br />
(絵文字不可)<br />
<?php 
if(!empty($form)) {
    echo $form->renderGlobalErrors();
    echo $form['comment']->renderError();
}
?>
<form action="?guid=ON" method="POST">
<textarea name="comment" cols="20" rows="5"><?php echo $sf_params->get('comment')?></textarea>
<br />

<input type="hidden" name="event_id" value="<?php echo $sf_params->get('event_id')?>" />
<input type="hidden" name="id" value="<?php echo $sf_params->get('id')?>" />
<input name="url" type="hidden" value="<?php echo sfConfig::get('sf_mixi_get_event_detail_url') ?>" />
<input type="submit" value="書き込む"/>
</form>

