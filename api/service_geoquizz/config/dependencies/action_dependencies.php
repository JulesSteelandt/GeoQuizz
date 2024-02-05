<?php


use geoquizz\service\app\actions\GetProfilAction;
use geoquizz\service\app\actions\SetProfilAction;
use geoquizz\service\app\actions\GetSerieAction;
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

];