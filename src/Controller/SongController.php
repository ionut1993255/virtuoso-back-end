<?php

namespace App\Controller;

use App\Entity\Song;
use App\Repository\NoteRepository;
use App\Repository\SongRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SongController extends AbstractController
{
    /** @var SongRepository */
    private SongRepository $songRepository;

    /** @var NoteRepository */
    private NoteRepository $noteRepository;

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, SongRepository $songRepository, NoteRepository $noteRepository)
    {
        $this->entityManager = $entityManager;
        $this->songRepository = $songRepository;
        $this->noteRepository = $noteRepository;
    }

    #[Route('/songs', name: 'songs_getall', methods: ["GET"])]
    public function getAll(): JsonResponse
    {
        $data = $this->songRepository->findAll();

        return new JsonResponse($data, 200, [
            'Content-Type' => 'application/json'
        ]);
    }

    #[Route('/songs', name: 'songs_create', methods: ["POST"])]
    public function create(Request $request)
    {
        $jsonData = json_decode($request->getContent(), true);

        $song = new Song();
        $song->setName($jsonData["name"]);
        $song->setLength($jsonData["length"]);

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
