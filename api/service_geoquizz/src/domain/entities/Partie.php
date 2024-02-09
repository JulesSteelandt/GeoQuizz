<?php

namespace geoquizz\service\domain\entities;
use Illuminate\Database\Eloquent\Model;

class Partie extends Model
{
    protected $connection = 'geoquizz';
    protected $table = 'partie';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = false;

}