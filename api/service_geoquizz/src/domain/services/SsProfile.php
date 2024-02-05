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
}