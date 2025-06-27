<?php

namespace App\Controller;

use App\DTOs\UsuarioContaDTO;
use App\DTOs\UsuarioDTO;
use App\Entity\Conta;
use App\Entity\Usuarios;
use App\Repository\ContaRepository;
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
    public function post(
        #[MapRequestPayload(acceptFormat: 'json')]

        UsuarioDTO $usuarioDTO,

        EntityManagerInterface $entityManager,

        UsuariosRepository $usuarioRepository
    ): JsonResponse {
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
        if ($usuarioExistente) {
            return $this->json([
                'message' => 'O cpf informado já está cadastrado',
                409
            ]);
        }

        $usuario = new Usuarios();
        $usuario->setCpf($usuarioDTO->getCpf());
        $usuario->setNome($usuarioDTO->getNome());
        $usuario->setEmail($usuarioDTO->getEmail());
        $usuario->setSenha($usuarioDTO->getSenha());
        $usuario->setTelefone($usuarioDTO->getTelefone());

        $entityManager->persist($usuario);


        $conta = new Conta();
        $conta->setNumero(preg_replace('/\D/', '', uniqid()));
        $conta->setSaldo('0');
        $conta->setUsuario($usuario);

        $entityManager->persist(($conta));
        $entityManager->flush();

        $usuarioContaDTO = new UsuarioContaDTO();
        $usuarioContaDTO->setId($usuario->getId());
        $usuarioContaDTO->setNome($usuario->getNome());
        $usuarioContaDTO->setCpf($usuario->getCpf());
        $usuarioContaDTO->setEmail($usuario->getEmail());
        $usuarioContaDTO->setTelefone($usuario->getTelefone());
        $usuarioContaDTO->setNumeroConta($conta->getNumero());
        $usuarioContaDTO->setSaldo($conta->getSaldo());

        return $this->json($usuarioContaDTO, status: 201);
    }

    #[Route('/usuarios/{id}', name: 'usuarios_buscar', methods: ['GET'])]
    public function buscarPorId(
        int $id,
        ContaRepository $contaRepository
    ) {
        $conta = $contaRepository->findByUsuarioId($id);
        if (!$conta) {
            return $this->json([
                'message' => ''
            ], status: 404);
        }

        $usuarioContaDTO = new UsuarioContaDTO;

        $usuarioContaDTO = new UsuarioContaDTO();
        $usuarioContaDTO->setId($conta->getUsuario()->getId());
        $usuarioContaDTO->setNome($conta->getUsuario()->getNome());
        $usuarioContaDTO->setCpf($conta->getUsuario()->getCpf());
        $usuarioContaDTO->setEmail($conta->getUsuario()->getEmail());
        $usuarioContaDTO->setTelefone($conta->getUsuario()->getTelefone());
        $usuarioContaDTO->setNumeroConta($conta->getNumero());
        $usuarioContaDTO->setSaldo($conta->getSaldo());

        return $this->json($usuarioContaDTO);
    }
}
