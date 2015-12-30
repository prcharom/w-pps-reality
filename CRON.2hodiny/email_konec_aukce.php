<?php

require 'asystem.pps-eu.cz/vendor/autoload.php';
require 'CRON.2hodiny/functions.php';

$dsn = 'mysql:host=127.0.0.1;dbname=pps-eucz01';
$user = 'pps-eucz002';
$password = 'FZLAqHu6';

$connection = new Nette\Database\Connection($dsn, $user, $password);
$database = new Nette\Database\Context($connection);

$results = $database->table('nemovitost')->where('mod', 1)->where('TIMESTAMPDIFF(MINUTE, datum_konec, NOW()) BETWEEN 0 AND 120');

if($results) { // pokud mam nejake nemovitosti u kterych aukce skoncila v poslednich dvou hodinach

	foreach($results as $r) { // postupne tyto nemovitosti projedu

		$prihozy = $database->table('drazba')->where('id_nemovitost', $r->id);
		$drazba = analyzuj_drazbu($prihozy, $r);

        if($drazba) {

        		$kupce = $database->table('uzivatel')->get($drazba['id']);

        		if ($kupce->email  != null) {

	                // nastaveni parametru pro latte emailu
	                $latte = new Nette\Latte\Engine;
	                $params = array(
	                    'nemovitost' => $r,
	                    'kupce' => $kupce,
	                    'cena' => $drazba['cena'],
	                );

	                // nastaveni mailu
	                $mail = new Nette\Mail\Message;
	                $mail->setFrom('aukce.pps-reality@post.cz')
	                    ->addTo($kupce->email)
	                    ->setHtmlBody($latte->renderToString('CRON.2hodiny/email.latte', $params));

	                // poslani mailu
	                $mailer = new Nette\Mail\SmtpMailer(array(
	                        'host' => 'smtp.seznam.cz',
	                        'username' => 'aukce.pps-reality@post.cz',
	                        'password' => 'pps2015',
	                        'secure' => 'ssl',
	                ));
	                $mailer->send($mail);
	            }
        }

	}

}


