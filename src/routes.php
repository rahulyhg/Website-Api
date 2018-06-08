<?php
require __DIR__.'/../src/usersClass.php';
require __DIR__.'/../src/connection.php';
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \GimsSocial\User as User;

$app->get('/verifyuser', function (Request $request, Response $response, array $args) {
    if(!$request->getHeader('Authorization'))
    {
        return $response->withStatus(401)->withHeader('', 'HTTP/1.0 401 Unauthorized');
    }
    else
    {
        if($request->getHeader('Authorization')[0] == md5('pedrobelotto:username'))
        {
            $user = $request->getQueryParams();
            $username = $user['username'];
            $connection = new Connection();
            $connection->connectDb();
            $result = $connection->searchUsername($username);
            $connection->disconnectDb();
            $arr_result = array('result' => $result);
            return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($arr_result));
        }
    }
});

$app->get('/verifyemail', function (Request $request, Response $response, array $args) {
    if(!$request->getHeader('Authorization'))
    {
        return $response->withStatus(401)->withHeader('', 'HTTP/1.0 401 Unauthorized');
    }
    else
    {
        if($request->getHeader('Authorization')[0] == md5('pedrobelotto:username'))
        {
            $user = $request->getQueryParams();
            $email = $user['email'];
            $connection = new Connection();
            $connection->connectDb();
            $result = $connection->searchEmail($email);
            $connection->disconnectDb();
            $arr_result = array('result' => $result);
            return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($arr_result));
        }
        else 
        {
            return $response->withStatus(401)->withHeader('', 'HTTP/1.0 401 Unauthorized');
        }
    }
});

$app->get('/insertuser', function (Request $request, Response $response, array $args) {
    if(!$request->getHeader('Authorization'))
    {
        return $response->withStatus(401)->withHeader('', 'HTTP/1.0 401 Unauthorized');
    }
    else
    {
        if($request->getHeader('Authorization')[0] == md5('pedrobelotto:username'))
        {
            $user = $request->getQueryParams();
            if($user['account'] == 'Simple')
            {
                $client = new User($user['name'], $user['lastname'], $user['username'], $user['email'], $user['birthdate'], $user['password'], $user['account']);
                $connection = new Connection();
                $connection->connectDb();
                $result = $connection->registerUser($client);
                $connection->disconnectDb();
                $arr_result = array('result' => $result);
                return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($arr_result));
            }
        }
        else 
        {
            return $response->withStatus(401)->withHeader('', 'HTTP/1.0 401 Unauthorized');
        }
    }
});

?>