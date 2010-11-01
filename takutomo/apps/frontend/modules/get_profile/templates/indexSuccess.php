<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span style="font-size:small;">ﾌﾟﾛﾌｨｰﾙ</span>
</div>
<?php
  $evaluate = 0;
  if(intval($member['profile']['eval_good']) > 0)
    $evaluate += intval($member['profile']['eval_good']);
  
  if(intval($member['profile']['eval_normal']) > 0)
    $evaluate += intval($member['profile']['eval_normal']);

  if(intval($member['profile']['eval_bad']) > 0)
    $evaluate += intval($member['profile']['eval_bad']);

  if($evaluate > 0){
  	  echo "評価:{$evaluate}";
  	  echo "&nbsp;";
  	  echo '<a href="?guid=ON&url='.sfConfig::get('sf_mixi_get_eval_comments_url') .urlencode('?id='.$sf_params->get('id').'&m_id=' .$member['profile']['m_id']). '">詳細</a>';
  	  echo '<br />';
  } else{
  	  echo "評価:なし";
  	
  }
  echo '<hr />';
  	
foreach($member as $value){
  
  if($value['m_id']){
  	
  	#写真
  	if(!empty($value['pic1_url'])){
  	  echo '<img src="' .$value['pic1_url']. '" width="160" height="120"/><br />';
      echo '<hr />';
  	}
    
    if($value['type'] == "driver"){
      #タクシー運転手
      echo "{$value['name']}<br />";
      echo $value['introduction'];
      echo '<br />'; 
      echo '運賃体系<br />';
      echo "初乗り:{$value['min_fare_amount']}円({$value['min_fare_distance']}km)<br />";
      echo "その後:{$value['add_fare_amount']}円({$value['add_fare_distance']}m毎)<br />";
      echo "深夜:{$value['midnight_rate']}割増({$value['midnight_start']}〜{$value['midnight_end']}時)<br />";
      echo "長距離:{$value['long_discount_after']}円超{$value['long_discount_rate']}割引<br />";
      $pay ="";
      if($value['pay_credit_card'] == "yes")$pay .= "ｸﾚｼﾞｯﾄｶｰﾄ&nbsp;";
      if($value['pay_e_money'] == "yes")$pay .= "電子ﾏﾈ-&nbsp;";
      if($value['pay_ticket'] == "yes")$pay .= "ﾁｹｯﾄ&nbsp;";
      if(!empty($value['pay_other']))$pay .= $value['pay_other'];
      
      echo "決済方法:{$pay}<br />";
      echo '<hr />';
      echo "会社名:{$value['company']}<br />";
      echo "ﾀｸｼｰ運転歴:{$value['experience']}<br />";
      echo "無事故違反歴:{$value['accident']}<br />";
      echo "車種:{$value['car']}<br />";
      $equipment ="";
      if($value['equipment_etc'] == "yes")$equipment .= "ETC&nbsp;";
      if($value['equipment_navi'] == "yes")$equipment .= "ｶｰﾅﾋﾞ&nbsp;";
      if($value['equipment_no_smoke'] == "yes")$equipment .= "禁煙車&nbsp;";
      if(!empty($value['equipment_other']))$equipment .= $value['equipment_other'];
      echo "装備:{$equipment}<br />";
      echo "{$value['gender']}性 {$value['age']}<br />";
      
    }else{
      #ユーザー
      echo '<label name="name">氏名</label>&nbsp;';
      echo $value['name'];
      echo '<br />';
      echo '<label name="age">年齢</label>&nbsp;';
      echo $value['age'];
      echo '<br />';
      echo '<label name="gender">性別</label>&nbsp;';
      echo $value['gender'];
      echo '<br />';  
      echo '<label name="introduction">自己紹介</label><br />';
      echo $value['introduction'];
      echo '<br />';
      echo '<hr />';  
      echo '<label name="departure">よくﾀｸｼｰに乗ることがある出発地</label><br />';
      echo empty($value['from1'])? '' : $value['from1'] . '&nbsp;';
      echo empty($value['from2'])? '' : $value['from2'] . '&nbsp;';
      echo empty($value['from4'])? '' : $value['from4'] . '&nbsp;';
      echo empty($value['from3'])? '' : $value['from3'] . '&nbsp;';
      echo empty($value['from5'])? '' : $value['from5'] . '&nbsp;';
      echo '<hr />';  
      echo '<label name="departure">よくﾀｸｼｰに乗ることがある目的地</label><br />';
      echo empty($value['to1'])? '' : $value['to1'] . '&nbsp;';
      echo empty($value['to2'])? '' : $value['to2'] . '&nbsp;';
      echo empty($value['to3'])? '' : $value['to3'] . '&nbsp;';
      echo empty($value['to4'])? '' : $value['to4'] . '&nbsp;';
      echo empty($value['to5'])? '' : $value['to5'] . '&nbsp;';
      echo '<br />';
     	
    }
    echo '<hr />';
    echo '携帯の←（戻る）ボタンを押して戻って下さい。';
 }
}