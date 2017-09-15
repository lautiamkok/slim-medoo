<?php
// Tell the container how to construct the logger.
$container->add('Monolog\Logger', function() use ($container) {
    $settings = $container->get('settings')['logger'];
    $logger = new \Monolog\Logger($settings['name']);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
});
