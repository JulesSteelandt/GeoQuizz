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
        $tab = [];
        foreach ($series as $s){
            $tab[] = new SerieDTO($s->id, $s->nom);
        }
        return $tab;
    }

    public function getSerieById(int $id)
    {
        $series = SerieDTO::find($id);
        return new SerieDTO($series->id, $series->nom);
    }
}