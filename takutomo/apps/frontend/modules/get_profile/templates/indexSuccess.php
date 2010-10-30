<div style="text-align: left; background-color:#00ccff; color:#FFFFFF; margin:5px 0; padding-top:2px;">
<span style="font-size:small;">ﾌﾟﾛﾌｨｰﾙ</span>
</div>
<?php foreach($member as $value){
  
  if($value['m_id']){
  	
  	if((int)$value['eval_good'] > 1){
  	  echo "評価:{$value['eval_good']}";
  	  echo "&nbsp;";
  	  echo '<a href="?guid=ON&url='.sfConfig::get('sf_mixi_get_eval_comments_url') .urlencode('?id='.$sf_params->get('id').'&m_id=' .$value['m_id']). '">詳細</a>';
  	  echo '<br />';
  	echo '<hr />';
  	}
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
      echo '<br />';  
    
      echo '<label name="departure">よくﾀｸｼｰに乗ることがある</label><br />';
      echo '<label name="from1">出発地1</label><br />';
      echo empty($value['from1'])? 'なし' : $value['from1'];
      echo '<br />';  
      echo '<label name="to1">目的地1</label><br />';
      echo empty($value['to1'])? 'なし' : $value['to1'];
      echo '<br />';;   
      echo '<label name="from2">出発地2</label><br />';
      echo empty($value['from2'])? 'なし' : $value['from2'];
      echo '<br />';  
      echo '<label name="to2">目的地2</label><br />';
      echo empty($value['to2'])? 'なし' : $value['to2'];
      echo '<br />'; 
      echo '<label name="from3">出発地3</label><br />';
      echo empty($value['from3'])? 'なし' : $value['from3'];
      echo '<br />';  
      echo '<label name="to3">目的地3</label><br />';
      echo empty($value['to3'])? 'なし' : $value['to3'];
      echo '<br />'; 
      echo '<label name="from4">出発地4</label><br />';
      echo empty($value['from4'])? 'なし' : $value['from4'];
      echo '<br />';  
      echo '<label name="to4">目的地4</label><br />';
      echo empty($value['to4'])? 'なし' : $value['to4'];
      echo '<br />'; 
      echo '<label name="from5">出発地5</label><br />';
      echo empty($value['from5'])? 'なし' : $value['from5'];
      echo '<br />';  
      echo '<label name="to5">目的地5</label><br />';
      echo empty($value['to5'])? 'なし' : $value['to5'];
      echo '<br />';
      echo '<br />';
     	
    }
    echo '<hr />';
    echo '携帯の←（戻る）ボタンを押して戻って下さい。';
 }
}