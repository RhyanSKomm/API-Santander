<?php

namespace App\Controller;

use App\DTOs\UsuarioDTO;
use App\Entity\Usuarios;
use App\Repository\UsuariosRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/api')]
final class UsuariosController extends AbstractController
{
    #[Route('/usuarios', name: 'usuarios_create', methods: ['POST'])]
    public function post(#[MapRequestPayload(acceptFormat: 'json')]
            
            UsuarioDTO $usuarioDTO,

            EntityManagerInterface $entityManager,

            UsuariosRepository $usuarioRepository
        ): JsonResponse
    {
        $errors = [];

        if (!($usuarioDTO->getCpf())) {
            array_push($errors, [
                'message' => 'CPF é obrigatório!'
            ]);
        }
        if (!($usuarioDTO->getNome())) {
            array_push($errors, [
                'message' => 'Nome é obrigatório!'
            ]);
        }
        if (!($usuarioDTO->getEmail())) {
            array_push($errors, [
                'message' => 'Email é obrigatório!'
            ]);
        }
        if (!($usuarioDTO->getSenha())) {
            array_push($errors, [
                'message' => 'Senha é obrigatório!'
            ]);
        }
        if (!($usuarioDTO->getTelefone())) {
            array_push($errors, [
                'message' => 'Telefone é obrigatório!'
            ]);
        }
        if (count($errors) > 0) {
            return $this->json($errors, 422);
        }

        $usuarioExistente = $usuarioRepository->findByCpf($usuarioDTO->getCpf());
        if($usuarioExistente) {
            return $this->json([
                'message' => 'O cpf informado já está cadastrado', 409
            ]);
        }

        $usuario = new Usuarios();
        $usuario->setCpf($usuarioDTO->getCpf());
        $usuario->setNome($usuarioDTO->getNome());
        $usuario->setEmail($usuarioDTO->getEmail());
        $usuario->setSenha($usuarioDTO->getSenha());
        $usuario->setTelefone($usuarioDTO->getTelefone());

        $entityManager->persist($usuario);
        $entityManager->flush();

        return $this->json([]);
    }
}
