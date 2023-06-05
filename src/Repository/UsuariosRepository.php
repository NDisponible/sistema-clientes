<?php

namespace App\Repository;

use App\Entity\Usuarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository<Usuarios>
 *
 * @method Usuarios|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usuarios|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usuarios[]    findAll()
 * @method Usuarios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuariosRepository extends ServiceEntityRepository
{
    public const PAGINATOR_PER_PAGE = 4;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usuarios::class);
    }

    public function save(Usuarios $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Usuarios $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    /**
     * @return paginator
     */
    public function getUsuariosPaginator(int $offset): Paginator 
    {
        $query = $this->createQueryBuilder('u')
            ->orderBy('u.apellidos', 'ASC')
            ->setMaxResults(self::PAGINATOR_PER_PAGE)
            ->setFirstResult($offset)
            ->getQuery();
        return new Paginator($query);
    }
    /**
     * @return usuarios if exist by idCliente []
     */
    public function findByName(int $cliente): array 
    {
        $dbconn = $this->getEntityManager()->getConnection();
        $query = "SELECT id, nombre, apellidos, poblacion, categoria, edad, estado, 
                    fecha_creacion, fecha_modificacion, id_cliente FROM usuarios WHERE 
                    id_cliente= :cliente";
        $stm = $dbconn->prepare($query);
        $stm->execute(['cliente' => $cliente]);
        return $stm->fetchAllAssociative();
    }
    /**
     * @return pagination of usuarios searched by name
     */
    public function getUsuariosByNamePaginator(int $offset, int $idCliente): Paginator
    {
        $query = $this->createQueryBuilder('u')
        ->andWhere('u.idCliente = :idCLIENTE')
        ->setParameter('idCliente', $idCliente)
        ->orderBy('u.apellidos', 'ASC')
        ->setMaxResults(self::PAGINATOR_PER_PAGE)
        ->setFirstResult($offset)
        ->getQuery();
        return new Paginator($query);
    }

//    /**
//     * @return Usuarios[] Returns an array of Usuarios objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

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