<?php

namespace geoquizz\service\domain\entities;
use geoquizz\service\domain\DTO\UserDTO;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $connection = 'geoquizz';
    protected $table = 'serie';
    protected $primaryKey = 'id';
    public $timestamps = false;

}