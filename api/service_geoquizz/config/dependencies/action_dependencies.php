<?php


use geoquizz\service\app\actions\GetProfilAction;
use Psr\Container\ContainerInterface;

return[

    GetProfilAction::class => function (ContainerInterface $c){
        return new GetProfilAction($c->get('geoquizz.service'));
    },

];