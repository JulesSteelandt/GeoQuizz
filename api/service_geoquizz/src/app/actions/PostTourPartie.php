<?php

namespace geoquizz\service\app\actions;

use geoquizz\service\domain\services\SsPartie;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PostTourPartie extends AbstractAction
{
    private SsPartie $partieService;

    public function __construct(SsPartie $s)
    {
        $this->partieService = $s;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $parsedBody = json_decode($request->getBody(), true);
        $distance = $parsedBody['distance'];
        $temps = $parsedBody['temps'];
        $game_id = $parsedBody['game_id'];

        try {
            $res = $this->partieService->playParty($game_id, $distance, $temps);
            if ($res == 1){
                $response->getBody()->write(json_encode(["status" => $res, "message" => "La partie continue"]));
            } elseif ($res == 2){
                $response->getBody()->write(json_encode(["status" => $res, "message" => "La partie est terminé"]));
            }

            return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
        } catch (\Exception $e){
            $response->getBody()->write(json_encode(["message" => $e->getMessage()]));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }
    }
}