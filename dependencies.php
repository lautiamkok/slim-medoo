<?php
// Dependency Container
// Slim uses a dependency container to prepare, manage, and inject application
// dependencies. Slim supports containers that implement PSR-11 or the
// Container-Interop interface. -
// https://www.slimframework.com/docs/concepts/di.html

// Pleague Container
// Pleague Container is used in this app instead of Slim’s built-in container
// (based on Pimple).
// http://container.thephpleague.com/
// http://container.thephpleague.com/2.x/

$container = $app->getContainer();
require './dependencies/db.php';
require './dependencies/logger.php';
require './dependencies/404.php';
