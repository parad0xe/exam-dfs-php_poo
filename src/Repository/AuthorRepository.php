<?php


namespace App\Repository;


use App\Entity\Author;
use Parad0xeSimpleFramework\Core\ApplicationContext;
use Parad0xeSimpleFramework\Core\Http\Repository\AbstractRepository;

class AuthorRepository extends AbstractRepository
{
    public function __construct(ApplicationContext $context)
    {
        parent::__construct($context, Author::$TABLE, Author::class);
    }

    /**
     * @param int $id
     * @return mixed|null
     */
    public function find(int $id)
    {
        return $this->builder->select("*")
            ->where("id = :id")
            ->setParameter("id", $id)
            ->findOne();
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->builder->select("*")->findAll();
    }

    /**
     * @param string $email
     * @param string $password
     * @return Author|null
     */
    public function retrieve(string $email, string $password): ?Author {
        return $this->builder->select("*")
            ->where("email = :email")
            ->andWhere("password = :password")
            ->setParameters([
                "email" => $email,
                "password" => $password
            ])
            ->findOne();
    }
}
