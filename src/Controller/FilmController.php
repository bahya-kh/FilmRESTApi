<?php

namespace App\Controller;

use App\Repository\FilmRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FilmSiteController
 * @package App\Controller
 *
 * @Route(path="")
 */
class FilmController
{
    private $filmRepository;

    public function __construct(FilmRepository $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }

    /**
     * @Route("/films", name="add_film", methods={"POST"})
     */
    public function addFilm(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $title = $data['title'];
        $category = $data['category'];
        $viewsNumber = $data['viewsNumber'];
        $releaseYear = $data['releaseYear'];

        if (empty($title) || empty($category) || empty($viewsNumber) || empty($releaseYear)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->filmRepository->saveFilm($title, $category, $viewsNumber, $releaseYear);

        return new JsonResponse(['status' => 'Film added!'], Response::HTTP_CREATED);
    }

    /**
     * @Route("/films/{id}", name="get_one_film", methods={"GET"})
     */
    public function getOneFilm($id): JsonResponse
    {
        $film = $this->filmRepository->findOneBy(['id' => $id]);

        $data = [
            'id' => $film->getId(),
            'title' => $film->getTitle(),
            'category' => $film->getCategory(),
            'viewsNumber' => $film->getViewsNumber(),
            'releaseYear' => $film->getReleaseYear(),
        ];

        return new JsonResponse(['film' => $data], Response::HTTP_OK);
    }

    /**
     * @Route("/films", name="get_all_films", methods={"GET"})
     */
    public function getAllFilms(): JsonResponse
    {
        $films = $this->filmRepository->findAll();
        $data = [];

        foreach ($films as $film) {
            $data[] = [
                'id' => $film->getId(),
                'title' => $film->getTitle(),
                'category' => $film->getCategory(),
                'viewsNumber' => $film->getViewsNumber(),
                'releaseYear' => $film->getReleaseYear(),
            ];
        }

        return new JsonResponse(['films' => $data], Response::HTTP_OK);
    }

    /**
     * @Route("/films/{id}", name="update_film", methods={"PUT"})
     */
    public function updateFilm($id, Request $request): JsonResponse
    {
        $film = $this->filmRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        $this->filmRepository->updateFilm($film, $data);

        return new JsonResponse(['status' => 'film updated!']);
    }

    /**
     * @Route("/films/{id}", name="delete_film", methods={"DELETE"})
     */
    public function deleteFilm($id): JsonResponse
    {
        $film = $this->filmRepository->findOneBy(['id' => $id]);

        $this->filmRepository->removeFilm($film);

        return new JsonResponse(['status' => 'film deleted']);
    }
}
