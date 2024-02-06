<?php

namespace geoquizz\service\app\actions;

use geoquizz\service\domain\services\SsPartie;
use geoquizz\service\domain\services\SsProfile;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetHistoryAction extends AbstractAction
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
        $id = $tokenRes['email'];

        $history = $this->partieService->getHistory($id);

        $response->getBody()->write(json_encode($history));

        return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
    }
}