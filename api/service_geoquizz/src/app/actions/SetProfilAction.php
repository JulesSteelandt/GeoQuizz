<?php

namespace geoquizz\service\app\actions;

use geoquizz\service\domain\services\SsProfile;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SetProfilAction extends AbstractAction
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

            $body = json_decode($request->getBody(), true);

            //Faire appel ici pour récupérer l'id du gadjo
            $id = "";

            $profil = $this->profileService->setProfile($id, $body["prenom"], $body["nom"]);

            $response->getBody()->write(json_encode(["message" => "profile updaté"]));
        }

        return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
    }
}