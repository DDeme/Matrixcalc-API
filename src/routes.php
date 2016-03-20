<?php
// Routes
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require '../classes/calculate.php';

$app->get('/add/{position_a}/{position_b}', function (Request $request, Response $response) {


    // init class
    $calc = new calculate($request->getBody(),$request->getAttribute('position_a'),$request->getAttribute('position_b'));

    if (!$calc->validate()) {
        $response = $response->withHeader('Content-type', 'application/json')
                             ->withJson(['error' => $calc->error_message],$calc->error_code);
        return $response;
    }

    $result = $calc->add();

    $response = $response->withHeader('Content-type', 'application/json')
                         ->withJson(['result' => $result],200);

    return $response;
});

$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response = $response->withHeader('Content-type', 'application/json')
                         ->withJson(['error' => $name],200);

    return $response;
});


$app->get('/subtract/{position_a}/{position_b}', function (Request $request, Response $response) {
    // init class
    $calc = new calculate($request->getBody(),$request->getAttribute('position_a'),$request->getAttribute('position_b'));

    if (!$calc->validate()) {
        $response = $response->withHeader('Content-type', 'application/json')
                             ->withJson(['error' => $calc->error_message],$calc->error_code);
        return $response;
    }

    $result = $calc->subtract();

    $response = $response->withHeader('Content-type', 'application/json')
                         ->withJson(['result' => $result],200);

    return $response;
});


$app->get('/multiply/{position_a}/{position_b}', function (Request $request, Response $response) {
    // init class
    $calc = new calculate($request->getBody(),$request->getAttribute('position_a'),$request->getAttribute('position_b'));

    if (!$calc->validate()) {
        $response = $response->withHeader('Content-type', 'application/json')
                             ->withJson(['error' => $calc->error_message],$calc->error_code);
        return $response;
    }

    $result = $calc->multiply();

    $response = $response->withHeader('Content-type', 'application/json')
                         ->withJson(['result' => $result],200);

    return $response;
});


$app->get('/divide/{position_a}/{position_b}', function (Request $request, Response $response) {
    // init class
    $calc = new calculate($request->getBody(),$request->getAttribute('position_a'),$request->getAttribute('position_b'));

    if (!$calc->validate()) {
        $response = $response->withHeader('Content-type', 'application/json')
                             ->withJson(['error' => $calc->error_message],$calc->error_code);
        return $response;
    }

    $result = $calc->divide();

    if ($calc->error_code) {
        $response = $response->withHeader('Content-type', 'application/json')
                             ->withJson(['error' => $calc->error_message],$calc->error_code);
        return $response;
    }

    $response = $response->withHeader('Content-type', 'application/json')
                         ->withJson(['result' => $result],200);

    return $response;
});


/**another endpoints**/

$app->get('/sum[{range}]', function (Request $request, Response $response) {

    //echo $request->getAttribute('range');
    $calc = new calculate($request->getBody(),false,false,$request->getAttribute('range'));

    if (!$calc->validate()) {
        $response = $response->withHeader('Content-type', 'application/json')
                             ->withJson(['error' => $calc->error_message],$calc->error_code);
        return $response;
    }

    $result = $calc->sum();

    $response = $response->withHeader('Content-type', 'application/json')
                         ->withJson(['result' => $result],200);
    return $response;
});

$app->get('/product[{range}]', function (Request $request, Response $response) {
    $calc = new calculate($request->getBody(),false,false,$request->getAttribute('range'));

    if (!$calc->validate()) {
        $response = $response->withHeader('Content-type', 'application/json')
                             ->withJson(['error' => $calc->error_message],$calc->error_code);
        return $response;
    }

    $result = $calc->product();

    $response = $response->withHeader('Content-type', 'application/json')
                         ->withJson(['result' => $result],200);
    return $response;
});

$app->get('/max[{range}]', function (Request $request, Response $response) {
    $calc = new calculate($request->getBody(),false,false,$request->getAttribute('range'));

    if (!$calc->validate()) {
        $response = $response->withHeader('Content-type', 'application/json')
                             ->withJson(['error' => $calc->error_message],$calc->error_code);
        return $response;
    }

    $result = $calc->max();

    $response = $response->withHeader('Content-type', 'application/json')
                         ->withJson(['result' => $result],200);
    return $response;
});

$app->get('/min[{range}]', function (Request $request, Response $response) {
    $calc = new calculate($request->getBody(),false,false,$request->getAttribute('range'));

    if (!$calc->validate()) {
        $response = $response->withHeader('Content-type', 'application/json')
                             ->withJson(['error' => $calc->error_message],$calc->error_code);
        return $response;
    }

    $result = $calc->min();

    $response = $response->withHeader('Content-type', 'application/json')
                         ->withJson(['result' => $result],200);
    return $response;
});

$app->get('/average[{range}]', function (Request $request, Response $response) {
    $calc = new calculate($request->getBody(),false,false,$request->getAttribute('range'));

    if (!$calc->validate()) {
        $response = $response->withHeader('Content-type', 'application/json')
                             ->withJson(['error' => $calc->error_message],$calc->error_code);
        return $response;
    }

    $result = $calc->average();

    $response = $response->withHeader('Content-type', 'application/json')
                         ->withJson(['result' => $result],200);
    return $response;
});
