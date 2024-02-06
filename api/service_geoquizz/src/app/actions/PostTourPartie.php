<?php

namespace geoquizz\service\app\actions;

use geoquizz\service\domain\entities\Partie_cache;
use geoquizz\service\domain\services\SsPartie;
use geoquizz\service\domain\services\SsProfile;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PostTourPartie extends AbstractAction
{
    private SsPartie $partieService;

    public function __construct(SsPartie $s)
    {
        $this->partieService = $s;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $encodeTokenRes = $request->getAttribute("tokenValidationResult");
        $tokenRes = json_decode($encodeTokenRes, true);
        $parsedBody = json_decode($request->getBody(), true);
        $distance = $parsedBody['distance'];
        $temps = $parsedBody['temps'];
        $game_id = $parsedBody['game_id'];

        try {
            $res = $this->partieService->playParty($game_id, $distance, $temps);
            $response->getBody()->write(json_encode(["message" => $res]));
            return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
        } catch (\Exception $e){
            $response->getBody()->write(json_encode(["message" => $e->getMessage()]));
            return $response->withStatus($e->getCode())->withHeader('Content-Type', 'application/json');
        }
    }
}