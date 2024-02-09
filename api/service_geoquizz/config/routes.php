<?php
declare(strict_types=1);

use geoquizz\service\app\actions\GetHistoryAction;
use geoquizz\service\app\actions\GetPartie;
use geoquizz\service\app\actions\GetPartieById;
use geoquizz\service\app\actions\RecreatePartie;
use geoquizz\service\app\actions\GetSerieAction;
use geoquizz\service\app\actions\GetSerieByIdAction;
use geoquizz\service\app\actions\PostTourPartie;
use geoquizz\service\app\actions\PostCreatePartie;
use geoquizz\service\app\middlewares\CheckToken;


return function( \Slim\App $app):void {

    $app->get('/serie[/]', GetSerieAction::class)
        ->setName('getserie');

    $app->get('/serie/{id_serie}[/]', GetSerieByIdAction::class)
        ->setName('getidserie');

    $app->get('/historique[/]', GetHistoryAction::class)
        ->setName('historique');

    $app->get("/games[/]", GetPartie::class);

    $app->post("/games/create",PostCreatePartie::class);

    $app->post("/games/play",PostTourPartie::class);

    $app->get("/games/{id_partie}", GetPartieById::class);

    $app->post("/games/recreate/{id_partie}[/]", RecreatePartie::class)
        ->addMiddleware(new CheckToken());

    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response; // Renvoie une réponse HTTP vide
    });

    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        if (!$request->hasHeader('Origin')) {
            $origin = '*';
        } else {
            $origin = $request->getHeader('Origin');
        }
        return $response
            ->withHeader('Access-Control-Allow-Origin', $origin)
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
            ->withHeader('Access-Control-Allow-Credentials', 'true');
    });
};