<?php

namespace geoquizz\service\domain\services;

use geoquizz\service\domain\DTO\LocalisationDTO;
use geoquizz\service\domain\DTO\SerieDTO;
use geoquizz\service\domain\entities\Serie;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class SsSerie
{

    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     */
    public function getSerie()
    {
        $encodeRes = $this->client->get("/items/serie");
        $res = json_decode($encodeRes->getBody(), true);
        $tab = [];
        foreach ($res['data'] as $r){
            $tab[] = new SerieDTO($r['id'], $r['nom'], $r['photo']);
        }
        return $tab;
    }

    public function getSerieById(int $id)
    {
        $encodeRes = $this->client->get("/items/serie/".$id);
        $r = json_decode($encodeRes->getBody(), true);
        return new SerieDTO($r['data']['id'], $r['data']['nom'], $r['data']['photo']);
    }

    public function getLocalisationBySerie(int $id_serie){
        $tab = [];
            $encodeRes = $this->client->get('/items/serie/'.$id_serie);
            $res = json_decode($encodeRes->getBody(), true);

            $tableau_id = $res['data']['localisation'];
            $host = gethostbyname("directus");

            foreach ($tableau_id as $tdi){
                $encodeResDeux = $this->client->get('/items/localisation/'.$tdi);
                $resDeux = json_decode($encodeResDeux->getBody(), true);

                $tab[] = new LocalisationDTO($resDeux['data']['id'], $resDeux['data']['lieu'], "http://$host:8055/assets/".$resDeux['data']['photo'], $resDeux['data']['coordonnee']['coordinates']);
            }
        return $tab;
    }

    public function getLocalisationById($id)
    {
        $encodeRes = $this->client->get('/items/localisation/'.$id);
        $res = json_decode($encodeRes->getBody(), true);
        $data = $res['data'];
        $host = gethostbyname("directus");
        return new LocalisationDTO($data['id'], $data['lieu'], "http://$host:8055/assets/".$data['photo'], $data['coordonnee']['coordinates']);
    }
}