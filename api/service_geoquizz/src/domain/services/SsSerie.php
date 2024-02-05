<?php

namespace geoquizz\service\domain\services;

use geoquizz\service\domain\DTO\SerieDTO;
use geoquizz\service\domain\DTO\UserDTO;
use geoquizz\service\domain\entities\User;

class SsSerie
{
    public function getSerie()
    {
        $series = SerieDTO::all();
        return new SerieDTO($series->id, $series->nom);
    }
}