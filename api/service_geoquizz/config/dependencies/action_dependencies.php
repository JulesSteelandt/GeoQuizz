<?php


use geoquizz\service\app\actions\GetProfilAction;
use geoquizz\service\app\actions\SetProfilAction;
use geoquizz\service\app\actions\GetSerieAction;
use geoquizz\service\app\actions\GetSerieByIdAction;
use geoquizz\service\app\actions\GetHistoryAction;
use Psr\Container\ContainerInterface;

return[

    GetProfilAction::class => function (ContainerInterface $c){
        return new GetProfilAction($c->get('profile.service'));
    },

    SetProfilAction::class => function (ContainerInterface $c){
        return new SetProfilAction($c->get('profile.service'));
    },

    GetSerieAction::class => function (ContainerInterface $c){
        return new GetSerieAction($c->get('serie.service'));
    },

    GetSerieByIdAction::class => function (ContainerInterface $c){
        return new GetSerieByIdAction($c->get('serie.service'));
    },

    GetHistoryAction::class => function (ContainerInterface $c){
        return new GetHistoryAction($c->get('partie.service'));
    },

];