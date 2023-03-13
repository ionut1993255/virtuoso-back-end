<?php

namespace App\Controller;

use App\Entity\Song;
use App\Repository\SongRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SongController extends AbstractController
{
    /** @var SongRepository */
    private SongRepository $songRepository;

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, SongRepository $songRepository)
    {
        $this->entityManager = $entityManager;
        $this->songRepository = $songRepository;
    }

    #[Route('/songs', name: 'songs_getall', methods: ["GET"])]
    public function getAll(): JsonResponse
    {
        $data = $this->songRepository->findAll();

        return $this->json(json_encode($data));
    }

    #[Route('/songs', name: 'songs_create', methods: ["POST"])]
    public function create(Request $request)
    {
        $song = new Song();
        $song->setName($request->request->get('name'));
        $song->setLength($request->request->get('length'));

        $this->entityManager->persist($song);
        $this->entityManager->flush();

        return new Response('The song was saved!', 200);
    }

    #[Route('/songs/{id}', name: 'songs_delete', methods: ["DELETE"])]
    public function delete(int $id)
    {
        $song = $this->songRepository->findOneBy(array('id' => $id));

        $this->entityManager->remove($song);
        $this->entityManager->flush();

        return new Response('The song with id: ' . $id . ' was removed!', 200);
    }
}
