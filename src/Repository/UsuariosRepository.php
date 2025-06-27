<?php

namespace App\Repository;

use App\Entity\Usuarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Usuarios>
 */
class UsuariosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usuarios::class);
    }

    /**
    * @return Usuarios|null Returna um objeto de Usuario
    */
        public function findByCpf($cpf): Usuarios|null
        {
            return $this->createQueryBuilder('u')
                ->Where('u.cpf = :cpf')
                ->setParameter('cpf', $cpf)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }

    //    public function findOneBySomeField($value): ?Usuarios
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
