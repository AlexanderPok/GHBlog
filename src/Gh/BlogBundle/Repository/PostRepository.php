<?php
namespace Gh\BlogBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

class PostRepository extends DocumentRepository
{
    public function findRecent()
    {
        $qb = $this->createQueryBuilder()
            ->sort('created', 'DESC')
            ->limit(5);
        return $qb->getQuery()->execute();
    }

    public function findMostViewed()
    {
        $qb = $this->createQueryBuilder()
            ->sort('visitCount', 'DESC')
            ->limit(5);
        return $qb ->getQuery()->execute();
    }

    public function findTags()
    {
        $qb = $this->createQueryBuilder()
            ->map('
                function() {
                     if (!this.tags) {
                        return;
                    }
                    for (index in this.tags) {
                        emit(this.tags[index], 1);
                    }
                }
            ')
            ->reduce('
                function(previous, current) {
                    var count = 0;
                    for (index in current) {
                        count += current[index];
                    }
                    return count;
                }
            ');
        return $qb->getQuery()->execute();
    }

    public function findBySlug($slug)
    {
        $qb = $this->createQueryBuilder()
            ->field('slug')->equals($slug);
        return $qb->getQuery()->getSingleResult();
    }

    public function increaseVisitsById($id)
    {
        $qb = $this->createQueryBuilder()
            ->update()
            ->field('id')->equals($id)
            ->field('visitCount')->inc(1);
        return $qb->getQuery()->execute();
    }
}