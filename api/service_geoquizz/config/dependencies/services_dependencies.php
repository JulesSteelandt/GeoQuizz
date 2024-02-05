<?php


use \geoquizz\service\domain\services\SsProfile;
use geoquizz\service\domain\services\SsSerie;
use geoquizz\service\domain\services\SsPartie;
use Psr\Container\ContainerInterface;

return [

    'profile.service' => function (ContainerInterface $c) {
        return new SsProfile();
    },
    'serie.service' => function (ContainerInterface $c) {
        return new SsSerie();
    },
    'partie.service' => function (ContainerInterface $c) {
        return new SsPartie();
    },

];