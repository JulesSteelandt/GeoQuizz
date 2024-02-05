<?php

namespace geoquizz\service\app\actions;

use geoquizz\service\domain\services\SsProfile;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetProfilAction extends AbstractAction
{
    private SsProfile $profileService;

    public function __construct(SsProfile $s)
    {
        $this->profileService = $s;
    }
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $headers = $request->getHeaders();
        if (isset($headers['Authorization'])) {
            $header = $request->getHeader('Authorization')[0];
            $token = str_replace('Bearer ', '', $header);

            //Faire appel ici pour récupérer l'id du gadjo
            $id = "";

            $profil = $this->profileService->getProfile($id);

            $response->getBody()->write($profil->toJSON());
        }

        return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
    }
}