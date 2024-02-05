<?php

namespace geoquizz\service\domain\services;

use geoquizz\service\domain\DTO\PartieDTO;
use geoquizz\service\domain\DTO\SerieDTO;
use geoquizz\service\domain\DTO\UserDTO;
use geoquizz\service\domain\entities\Partie;
use geoquizz\service\domain\entities\User;

class SsPartie
{
    public function getHistory($user_id)
    {
        $parties = Partie::where("user_id", $user_id);
        $tab = [];
        foreach ($parties as $p){
            $tab[] = new PartieDTO($p->id, $p->user_id, $p->score, $p->difficulte, $p->serie_id);
        }
        return $tab;
    }
}