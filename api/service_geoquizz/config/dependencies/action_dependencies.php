<?php


use geoquizz\service\app\actions\GetProfilAction;
use geoquizz\service\app\actions\SetProfilAction;
use Psr\Container\ContainerInterface;

return[

    GetProfilAction::class => function (ContainerInterface $c){
        return new GetProfilAction($c->get('geoquizz.service'));
    },

    SetProfilAction::class => function (ContainerInterface $c){
        return new SetProfilAction($c->get('geoquizz.service'));
    },

];