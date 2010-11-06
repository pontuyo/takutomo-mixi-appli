<?php
if (!isset($_SERVER['SYMFONY']))
{
  throw new RuntimeException('Could not find symfony core libraries.');
}
if (!isset($_SERVER['SF_TEST_TO_ADDRESS']))
{
  throw new RuntimeException('Could not find "SF_TEST_TO_ADDRESS".');
}

if (!isset($app))
{
  $app = 'frontend';
}

require_once $_SERVER['SYMFONY'].'/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

// this functional test is as same as unit test.
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
