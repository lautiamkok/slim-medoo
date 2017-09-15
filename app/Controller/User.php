<?php
namespace App\Controller;

// PSR 7 standard.
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Medoo\Medoo;
use \Monolog\Logger;
use \Ramsey\Uuid\Uuid;

class User
{
    protected $database;

    public function __construct(
        Medoo $database,
        Logger $logger
    ) {
        $this->database = $database;

        // Log anything.
        $logger->addInfo("Logged from user controller");
    }

    public function fetchUsers(Request $request)
    {
        // Columns to select.
        $columns = [
            'uuid',
            'name',
            'created_on',
            'updated_on',
        ];

        // Get user(s).
        // https://medoo.in/api/select
        $collection = $this->database->select('user', $columns);

        // Return the result.
        return $collection;
    }

    public function fetchUser(Request $request, array $args)
    {
        // Columns to select.
        $columns = [
            'uuid',
            'name',
            'created_on',
            'updated_on',
        ];

        // Get user.
        // https://medoo.in/api/get
        $data = $this->database->get('user', $columns, [
            "name" => $args['name']
        ]);

        // Throw error if no result found.
        if ($data === false) {
            throw new \Exception('No user found', 400);
        }

        return $data;
    }

    public function insertUser(Request $request)
    {
        // Get params and validate them here.
        $name = $request->getParam('name');
        $email = $request->getParam('email');

        // Throw if empty.
        if (!$name) {
            throw new \Exception('$name is empty', 400);
        }

        // Throw if empty.
        if (!$email) {
            throw new \Exception('$email is empty', 400);
        }

        // Create a timestamp.
        $date = new \DateTime();
        $timestamp = $date->getTimestamp();
        // Or:
        // $timestamp = time();

        // Generate a version 1 (time-based) UUID object.
        // https://github.com/ramsey/uuid
        $uuid1 = Uuid::uuid1();
        $uuid = $uuid1->toString();

        // Assuming this is a model in a more complex app system.
        $model = new \stdClass;
        $model->uuid = $uuid;
        $model->name = $name;
        $model->email = $email;
        $model->created_on = $timestamp;

        // Insert user.
        // https://medoo.in/api/insert
        $result = $this->database->insert('user', [
            'uuid' => $model->uuid,
            'name' => $model->name,
            'email' => $model->email,
            'created_on' => $model->created_on
        ]);

        // Throw if it fails.
        // Returns the number of rows affected by the last SQL statement.
        if ($result->rowCount() === 0) {
            throw new \Exception('Insert row failed', 400);
        }

        // Return the model if it is OK.
        return $model;
    }

    public function updateUser(Request $request)
    {
        // Get params and validate them here.
        $uuid = $request->getParam('uuid');
        $name = $request->getParam('name');
        $email = $request->getParam('email');

        // Throw if empty.
        if (!$uuid) {
            throw new \Exception('$uuid is empty', 400);
        }

        // Throw if empty.
        if (!$name) {
            throw new \Exception('$name is empty', 400);
        }

        // Throw if empty.
        if (!$email) {
            throw new \Exception('$email is empty', 400);
        }

        // Create a timestamp.
        $date = new \DateTime();
        $timestamp = $date->getTimestamp();

        // Assuming this is a model in a more complex app system.
        $model = new \stdClass;
        $model->uuid = $uuid;
        $model->name = $name;
        $model->email = $email;
        $model->updated_on = $timestamp;

        // Update user.
        // https://medoo.in/api/update
        $result = $this->database->update("user", [
            "name" => $model->name,
            "email" => $model->email,
            'updated_on' => $model->updated_on,
        ], [
            "uuid" => $model->uuid
        ]);

        // Throw if it fails.
        // Returns the number of rows affected by the last SQL statement.
        if ($result->rowCount() === 0) {
            throw new \Exception('Update row failed', 400);
        }

        // Return the model if it is OK.
        return $model;
    }

    public function deleteUser(Request $request)
    {
        // Get params and validate them here.
        $uuid = $request->getParam('uuid');

        // Throw if empty.
        if (!$uuid) {
            throw new \Exception('$uuid is empty', 400);
        }

        // Assuming this is a model in a more complex app system.
        $model = new \stdClass;
        $model->uuid = $uuid;

        // Delete user.
        // https://medoo.in/api/delete
        $result = $this->database->delete("user", [
            "uuid" => $model->uuid
        ]);

        // Check the number of rows affected by the last SQL statement.
        // Throw if it fails.
        if ($result->rowCount() === 0) {
            throw new \Exception('Delete row failed', 400);
        }

        // Return the model if it is OK.
        return $model;
    }
}
