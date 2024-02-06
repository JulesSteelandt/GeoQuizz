<?php

namespace geoquizz\service\app\actions;

use geoquizz\service\domain\entities\Partie_cache;
use geoquizz\service\domain\services\SsPartie;
use geoquizz\service\domain\services\SsProfile;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PostCreatePartie extends AbstractAction
{
    private SsPartie $partieService;

    public function __construct(SsPartie $s)
    {
        $this->partieService = $s;
    }
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $encodeTokenRes = $request->getAttribute("tokenValidationResult");
        $tokenRes = json_decode($encodeTokenRes, true);
        $parsedBody = json_decode($request->getBody(), true);
        $id = $tokenRes['email'];
        $serie_id = $parsedBody['serie_id'];

        $res = $this->partieService->createParty($serie_id, $id);
        $response->getBody()->write(json_encode($res));

        return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
    }
}