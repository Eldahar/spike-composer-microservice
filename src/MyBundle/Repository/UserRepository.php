<?php

namespace MyBundle\Repository;


use Doctrine\ODM\MongoDB\DocumentRepository;

class UserRepository extends DocumentRepository
{

    public function findAllByEmail(string $email) {
        return $this->createQueryBuilder()
            ->field('email')->equals($email)
            ->limit(10)
            ->getQuery()
            ->execute();
    }
}