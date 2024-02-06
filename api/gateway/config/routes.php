<?php
declare(strict_types=1);


use geoquizz\gate\app\actions\authentification\MethodAuthentificationAction;
use geoquizz\gate\app\actions\game\MethodGameAction;

return function(\Slim\App $app):void {


    //AUTH
    $app->post("/signin", MethodAuthentificationAction::class)
        ->setName("signIn");

    $app->post("/signup", MethodAuthentificationAction::class)
        ->setName("signUp");

    $app->post('/users/refresh', MethodAuthentificationAction::class)
        ->setName('refreshUser');

    $app->get('/users/validate', MethodAuthentificationAction::class)
        ->setName('validateTokenJWT');

    //GAME

    $app->get('/serie[/]', MethodGameAction::class)
        ->setName('getserie');

    $app->get('/serie/{id_serie}[/]', MethodGameAction::class)
        ->setName('getidserie');

    $app->get('/historique[/]', MethodGameAction::class)
        ->setName('historique');

    $app->post("/games/create",MethodGameAction::class);

    $app->post("/games/play",MethodGameAction::class);

    //CORS
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