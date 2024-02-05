<?php

namespace geoquizz\service\app\actions;

use geoquizz\service\domain\services\SsProfile;
use geoquizz\service\domain\services\SsSerie;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetSerieByIdAction extends AbstractAction
{
    private SsSerie $serieService;

    public function __construct(SsProfile $s)
    {
        $this->serieService = $s;
    }
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $serie = $this->serieService->getSerieById($args['id_serie']);
        $response->getBody()->write($serie->toJSON());

        return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
    }
}