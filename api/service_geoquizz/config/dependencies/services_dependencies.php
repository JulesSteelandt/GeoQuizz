<?php


use \geoquizz\service\domain\services\SsProfile;
use Psr\Container\ContainerInterface;

return [

    'geoquizz.service' => function (ContainerInterface $c) {
        return new SsProfile();//pas de logger pour l'instant
    },

];