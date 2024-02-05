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
        $headers = $request->getHeaders();
        if (isset($headers['Authorization'])) {
            $header = $request->getHeader('Authorization')[0];
            $token = str_replace('Bearer ', '', $header);

            //Faire appel ici pour récupérer l'id du gadjo
            $id = "";

            $history = $this->partieService->getHistory($id);

            $response->getBody()->write($history);
        }

        return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
    }
}