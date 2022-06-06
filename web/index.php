<?php

require('../vendor/autoload.php');
use TheIconic\Tracking\GoogleAnalytics\Analytics;

$analytics = new Analytics();
$analytics->setProtocolVersion('1')
    ->setTrackingId('UA-145467675-1')
    ->setClientId('2133506694.1448249699')
    ->setUserId('123');

$analytics->setEventCategory('Checkout')
    ->setEventAction('Purchase')
    ->sendEvent();



$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});

$app->run();
