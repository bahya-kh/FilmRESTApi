<?php

namespace App\Repository;

use App\Entity\Film;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Film|null find($id, $lockMode = null, $lockVersion = null)
 * @method Film|null findOneBy(array $criteria, array $orderBy = null)
 * @method Film[]    findAll()
 * @method Film[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmRepository extends ServiceEntityRepository
{
    private $manager;

    public function __construct
    (
        ManagerRegistry $registry,
        EntityManagerInterface $manager
    )
    {
        parent::__construct($registry, Film::class);
        $this->manager = $manager;
    }

    public function saveFilm($title, $category, $viewsNumber, $releaseYear)
    {
        $newFilm = new Film();

        $newFilm
            ->setTitle($title)
            ->setCategory($category)
            ->setViewsNumber($viewsNumber)
            ->setReleaseYear($releaseYear);

        $this->manager->persist($newFilm);
        $this->manager->flush();
    }

    public function updateFilm(Film $film, $data)
    {
        empty($data['title']) ? true : $film->setTitle($data['title']);
        empty($data['category']) ? true : $film->setCategory($data['category']);
        empty($data['viewsNumber']) ? true : $film->setViewsNumber($data['viewsNumber']);
        empty($data['releaseYear']) ? true : $film->setReleaseYear($data['releaseYear']);

        $this->manager->flush();
    }

    public function removeFilm(Film $film)
    {
        $this->manager->remove($film);
        $this->manager->flush();
    }
}
