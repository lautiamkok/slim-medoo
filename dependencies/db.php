<?php
// Tell the container how to construct the db.
// https://medoo.in/api/collaboration
$container->add('Medoo\Medoo', function() {
    $dbconfig = require './config/database.php';
    return new \Medoo\Medoo([
        'database_type' => 'mysql',
        'database_name' => $dbconfig['name'],
        'server' => $dbconfig['host'],
        'username' => $dbconfig['username'],
        'password' => $dbconfig['password']
    ]);
});
