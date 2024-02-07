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
            $tab[] = new SerieDTO($r['id'], $r['nom']);
        }
        return $tab;
    }

    public function getSerieById(int $id)
    {
        $series = Serie::find($id);
        return new SerieDTO($series->id, $series->nom);
    }

    public function getLocalisationBySerie(int $id_serie){
        $tab = [];
            $encodeRes = $this->client->get('/items/serie/'.$id_serie);
            $res = json_decode($encodeRes->getBody(), true);

            $tableau_id = $res['data']['localisation'];
            $host = gethostbyname("directus");

            foreach ($tableau_id as $tdi){
                $encodeResDeux = $encodeRes = $this->client->get('/items/localisation/'.$tdi);
                $resDeux = json_decode($encodeResDeux->getBody(), true);

                $tab[] = new LocalisationDTO($resDeux['data']['id'], "http://$host:8055/assets/".$resDeux['data']['image'], $resDeux['data']['map']['coordinates']);
            }
        return $tab;
    }
}