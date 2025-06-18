<?php

namespace App\Controller;

use App\DTOs\UsuarioDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/api')]
final class UsuariosController extends AbstractController
{
    #[Route('/usuarios', name: 'usuarios_create', methods: ['POST'])]
    public function post(#[MapRequestPayload(acceptFormat: 'json')]
        UsuarioDTO $usuarioDTO): JsonResponse
    {
        dd($usuarioDTO);

        return $this->json([
            'message' => 'Controller',
            'path' => 'src/Controller/UsuariosController.php'
        ]);
    }
}
