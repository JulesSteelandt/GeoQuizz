<?php

namespace geoquizz\service\domain\DTO;

class UserDTO extends DTO
{
    public string $prenom;
    public string $nom;

    /**
     * @param string $prenom
     * @param string $nom
     */
    public function __construct(string $prenom, string $nom)
    {
        $this->prenom = $prenom;
        $this->nom = $nom;
    }


}