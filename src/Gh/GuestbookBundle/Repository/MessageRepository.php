<?php
namespace Gh\GuestbookBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

class MessageRepository extends DocumentRepository
{
    public function findLastMessages()
    {
        return $this->createQueryBuilder()
            ->sort('id', 'DESC')
            ->limit(5)
            ->getQuery()
            ->execute();
    }

}