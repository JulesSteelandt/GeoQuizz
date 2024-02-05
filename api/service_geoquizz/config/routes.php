<?php
declare(strict_types=1);

use geoquizz\service\app\actions\GetProfilAction;

return function( \Slim\App $app):void {

    $app->get('/profil[/]', GetProfilAction::class)
        ->setName('getprofil');

    $app->put('/profil[/]', )
        ->setName('setprofil');

    $app->get('/serie[/]', )
        ->setName('getserie');

    $app->get('/serie/{id_serie}[/]', )
        ->setName('getidserie');

    $app->get('/historique[/]', )
        ->setName('historique');

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