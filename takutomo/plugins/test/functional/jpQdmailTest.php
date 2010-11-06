<?php
include(dirname(__FILE__) . '/../bootstrap/functional.php');
$t = new lime_test(2, new lime_output_color());
$t->diag('send mail by Qdmail');
// success to send a mail
$process = true;
try {
    $mailer = jpSimpleMail::create('Qdmail');
    $mailer->setSubject($params['subject']);
    $mailer->setSender($_SERVER['SF_TEST_TO_ADDRESS']);
    $mailer->addTo(sprintf('%s <%s>', $params['to_name'], $_SERVER['SF_TEST_TO_ADDRESS']));
    $mailer->setFrom(sprintf('%s <%s>', $params['to_name'], $params['from']));
    $mailer->setBody($params['body']);
    $mailer->send();
} catch (jpSendMailException $e) {
  $process = false;
}
$t->is($process, true, 'succeess to send mail');
// fail to send a mail
$proccess = true;
try{
    $mailer = jpSimpleMail::create('Qdmail');
    $mailer->setSubject($params['subject']);
    $mailer->setSender($_SERVER['SF_TEST_TO_ADDRESS']);
//    $mailer->addTo(sprintf('%s <%s>', $params['to_name'], $_SERVER['SF_TEST_TO_ADDRESS']));
    $mailer->setFrom(sprintf('%s <%s>', $params['from_name'], $params['from']));
    $mailer->setBody($params['body']);
    $mailer->send();
} catch (jpSendMailException $e) {
  $proccess = false;
}
$t->is($proccess, false, 'catch the jpSendMailException');
