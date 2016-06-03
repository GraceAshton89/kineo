<?php

require_once __DIR__.'/vendor/autoload.php';

$app = new Silex\Application();

require_once __DIR__ . '/db/index.php';

// Create tables
$sql = 'CREATE TABLE IF NOT EXISTS `constituencies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
';

$res = $app['db']->executeQuery($sql);

$sql = 'CREATE TABLE IF NOT EXISTS `parties` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(180) DEFAULT NULL,
  `colour` int(11) DEFAULT NULL,
  `code` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
';	

$res = $app['db']->executeQuery($sql);

$sql = 'CREATE TABLE `votes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vote` int(11) DEFAULT NULL,
  `constituency` int(11) DEFAULT NULL,
  `party` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
';

$res = $app['db']->executeQuery($sql);

// Get constituencies
$curl = curl_init();

curl_setopt_array(
    $curl, array( 
    CURLOPT_URL => 'http://www.theyworkforyou.com/api/getConstituencies?&output=php&key=GJ4ermDihZhAF5qhXvCKZ4LT',
    CURLOPT_RETURNTRANSFER => true
));

$output = unserialize(curl_exec($curl));

foreach( $output as $c ) {
	$sql = 'INSERT INTO `constituencies` (`name`) VALUES ("' . mysql_real_escape_string($c['name']) . '")';
	$res = $app['db']->executeQuery($sql);
}

// Get parties
curl_setopt_array(
    $curl, array( 
    CURLOPT_URL => 'http://opinionbee.uk/json/parties',
    CURLOPT_RETURNTRANSFER => true
));

$output = json_decode(curl_exec($curl), true);


foreach( $output as $c ) {
	$sql = 'INSERT INTO `parties` (`name`, `colour`, `code`) 
		VALUES (
			"' . mysql_real_escape_string($c['name']) . '",
			"' . mysql_real_escape_string($c['colour'])  . '",
			"' . mysql_real_escape_string($c['code'])  . '"
			)';
	$res = $app['db']->executeQuery($sql);
}


header('http://localhost:8000/kineo/vote'); 