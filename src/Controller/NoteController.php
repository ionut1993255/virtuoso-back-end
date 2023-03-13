<?php

namespace App\Controller;

use App\Entity\Note;
use App\Repository\NoteRepository;
use App\Repository\SongRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Expr\List_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NoteController extends AbstractController
{
    private NoteRepository $noteRepository;

    private SongRepository $songRepository;

    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager,
        NoteRepository $noteRepository,
        SongRepository $songRepository
    ) {
        $this->entityManager = $entityManager;
        $this->noteRepository = $noteRepository;
        $this->songRepository = $songRepository;
    }

    #[Route('/notes/{songId}', name: 'notes_getbyid', methods: ["GET"])]
    public function getAll(int $songId): JsonResponse
    {
        $data = $this->noteRepository->getNotesOfSong($songId);

        return $this->json(json_encode($data));
    }

    #[Route('/notes', name: 'notes_create', methods: ["POST"])]
    public function create(Request $request)
    {
        $songList = $this->songRepository->findAll();

        $song = $songList[sizeof($songList) - 1];

        $noteList = json_decode($request->getContent(), true);
        foreach ($noteList as $jsonNote) {
            $note = new Note();
            $note->setSong($song);
            $note->setInstrument($jsonNote["instrument"]);
            $note->setNote($jsonNote['note']);
            $note->setTime($jsonNote['time']);

            $this->entityManager->persist($note);
        }

        $this->entityManager->flush();

        return new Response('The notes for song id: ' . $song->getId() . ' were saved!', 200);
    }
}
