<?php
namespace App\Repository;
use App\Entity\Match;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
/**
 * @method Match|null find($id, $lockMode = null, $lockVersion = null)
 * @method Match|null findOneBy(array $criteria, array $orderBy = null)
 * @method Match[]    findAll()
 * @method Match[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatchRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Match::class);
    }
    // /**
    //  * @return Match[] Returns an array of Match objects
    //  */
    public function orderByWeek()
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.week', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
    public function getWeekMatches($week)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.week = :week')
            ->setParameter('week', $week)
            ->getQuery()
            ->getResult()
            ;
    }
    public function getTeamMatches($team)
    {
        return $this->createQueryBuilder('m')
            ->orWhere('m.awayTeam = :team')
            ->orWhere('m.homeTeam = :team')
            ->andWhere('m.isFinish = 1')
            ->setParameter('team', $team)
            ->getQuery()
            ->getResult()
            ;
    }
}