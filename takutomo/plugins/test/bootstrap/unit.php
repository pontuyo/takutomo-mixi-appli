<?php
if (!isset($_SERVER['SYMFONY']))
{
  throw new RuntimeException('Could not find symfony core libraries.');
}
if (!isset($_SERVER['SF_TEST_TO_ADDRESS']))
{
  throw new RuntimeException('Could not find "SF_TEST_TO_ADDRESS".');
}
require_once $_SERVER['SYMFONY'].'/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

$configuration = new sfProjectConfiguration(getcwd());
require_once $configuration->getSymfonyLibDir().'/vendor/lime/lime.php';

require_once dirname(__FILE__).'/../../config/jpSimpleMailPluginConfiguration.class.php';
$plugin_configuration = new jpSimpleMailPluginConfiguration($configuration, dirname(__FILE__).'/../..');

// set ini
mb_internal_encoding('utf-8');
// test params
$params = array(
                'subject' => "長いサブジェクトです長いサブジェクトです長いサブジェクトです長いサブジェクトです長いサブジェクトです長いサブジェクトです長いサブジェクトです長いサブジェクトです",
                'body' => "本文です。テストです。",
                'from' => 'from@example.com',
                'from_name' => '送信元',
                'to_name' => '送信先',
                'return_path' => 'return_path@example.com',
                'reply_to' => 'reply_to@example.com',
                );
//encoded_value
$params['encoded_subject'] = mb_encode_mimeheader($params['subject'], 'iso-2022-jp', 'B', "\n");
$params['encoded_from_name'] = mb_encode_mimeheader($params['from_name'], 'iso-2022-jp', 'B', "\n");
$params['encoded_to_name'] = mb_encode_mimeheader($params['to_name'], 'iso-2022-jp', 'B', "\n");
$params['encoded_body'] = mb_convert_encoding($params['body'], 'iso-2022-jp', mb_internal_encoding());