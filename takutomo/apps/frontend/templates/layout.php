<?php if($sf_request->getAttribute('userAgent')->isDoCoMo())
  echo header('Content-type: application/xhtml+xml');
?>
<?php echo "<?xml version=\"1.0\" encoding=\"Shift_JIS\"?>\n" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <title>タクトモ</title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <style type="text/css">
      <![CDATA[
        a:link{color:#00ccff;}
        a:focus{color:#00ccff;}
        a:visited{color:#00ccff;}
      ]]>
    </style>
  </head>
  <body>
    <img src="<?php echo sfConfig::get('sf_mixi_index_url') ?>images/takutomo.jpg" /><br />
   <!-- <div style="font-size:x-small;">-->
    <?php echo $sf_content ?>
    <!--</div>-->
    <hr>
    <!--<div style="font-size:small;">-->
    <?php 
    echo sfJpMobile::getEmoji()->convert('&#xE6EA;');//9の文字
    echo '<a href="?guid=ON&url='.sfConfig::get('sf_mixi_member_url').'" accesskey="9">ﾀｸﾄﾓﾒﾆｭｰ</a>'?>
    <!--</div>-->
    <div style="text-align:center; background-color:#00ccff; color:#000000; margin:5px 0; padding-top:2px;">
      <!--<span sytle="font-size:small;">-->(c)Skymint Co.,Ltd.<!--</span>-->
    </div>
  </body>
</html>
