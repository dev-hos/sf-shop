<?php

declare(strict_types=1);

namespace App\Catalog;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/** @extends ServiceEntityRepository<Product> */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /** @return list<Product> */
    public function all(): array
    {
        return $this->findBy([], ['name' => 'ASC']);
    }

    public function find(mixed $id, \Doctrine\DBAL\LockMode|int|null $lockMode = null, ?int $lockVersion = null): ?Product
    {
        return parent::find($id, $lockMode, $lockVersion);
    }

    public function findOneBySlug(string $slug): ?Product
    {
        return $this->findOneBy(['slug' => $slug]);
    }
}
