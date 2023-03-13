<?php

namespace App\Repository;

use App\Entity\Note;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

final class NoteRepository extends ServiceEntityRepository
{
    private $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct($registry, Note::class);
    }

    public function getNotesOfSong(int $songId)
    {
        $result = $this->entityManager->createQuery(
            "SELECT n FROM App\Entity\Note n
            JOIN n.song s WHERE s.id = :songId"
        )->setParameter('songId', $songId);

        return $result->getResult();
    }
}
