<?php

namespace geoquizz\service\domain\services;

use geoquizz\service\domain\DTO\PartieDTO;
use geoquizz\service\domain\entities\Partie;

class SsPartie
{
    public function getHistory($user_id)
    {
        $parties = Partie::where("user_id", $user_id)->get();
        $tab = [];
        foreach ($parties as $p){
            $tab[] = new PartieDTO($p->id, $p->user_id, $p->score, $p->difficulte, $p->serie_id);
        }
        return $tab;
    }
}