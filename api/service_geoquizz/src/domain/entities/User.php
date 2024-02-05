<?php

namespace geoquizz\service\domain\entities;
use geoquizz\service\domain\DTO\UserDTO;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $connection = 'geoquizz';
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public function toDTO():UserDTO
    {
        return new UserDTO(
            $this->prenom,
            $this->nom
        );
    }

}