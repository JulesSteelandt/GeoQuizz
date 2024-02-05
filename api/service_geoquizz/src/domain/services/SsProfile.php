<?php

namespace geoquizz\service\domain\services;

use geoquizz\service\domain\DTO\UserDTO;
use geoquizz\service\domain\entities\User;

class SsProfile
{
    public function getProfile(int $id)
    {
        $user = User::find($id);
        return new UserDTO($user->prenom, $user->nom);
    }

    public function setProfile(int $id, string $prenom, string $nom)
    {
        try {
            User::where('id', $id)->update(['prenom' => $prenom, 'nom' => $nom]);
        } catch (\Error $e){
            return false;
        }

    }
}