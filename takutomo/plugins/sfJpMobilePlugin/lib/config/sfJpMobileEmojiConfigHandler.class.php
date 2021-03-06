<?php
/* vim:set expandtab tabstop=2 softtabstop=2 shiftwidth=2: */
/**
 * 絵文字変換テーブルファイル用パーサー
 *
 * @package     sfJpMobile
 * @subpackage  config
 * @version     $Id$
 */
class sfJpMobileEmojiConfigHandler extends sfYamlConfigHandler
{
  public function execute($configFiles)
  {
    $config = $this->parseYamls($configFiles);
    $format = "<?php\n"
            . "// auto-generated by %s\n"
            . "// date: %s\n"
            . "sfConfig::add(array('jpmobile_emoji_%s' => %s));"
            . "";
    return sprintf($format, __CLASS__, date('Y/m/d H:i:s'), key($config), var_export(current($config), true));
  }
}
