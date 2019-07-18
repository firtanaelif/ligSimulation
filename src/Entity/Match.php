<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\MatchRepository")
 * @ORM\Table(name="`match`")
 */
class Match
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="matches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $homeTeam;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="matches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $awayTeam;
    /**
     * @ORM\Column(type="integer")
     */
    private $homeGoalCount;
    /**
     * @ORM\Column(type="integer")
     */
    private $awayGoalCount;
    /**
     * @ORM\Column(type="boolean")
     */
    private $isFinish;
    /**
     * @ORM\Column(type="integer")
     */
    private $week;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getHomeTeam(): ?Team
    {
        return $this->homeTeam;
    }
    public function setHomeTeam(?Team $homeTeam): self
    {
        $this->homeTeam = $homeTeam;
        return $this;
    }
    public function getAwayTeam(): ?Team
    {
        return $this->awayTeam;
    }
    public function setAwayTeam(?Team $awayTeam): self
    {
        $this->awayTeam = $awayTeam;
        return $this;
    }
    public function getHomeGoalCount(): ?int
    {
        return $this->homeGoalCount;
    }
    public function setHomeGoalCount(int $homeGoalCount): self
    {
        $this->homeGoalCount = $homeGoalCount;
        return $this;
    }
    public function getAwayGoalCount(): ?int
    {
        return $this->awayGoalCount;
    }
    public function setAwayGoalCount(int $awayGoalCount): self
    {
        $this->awayGoalCount = $awayGoalCount;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getIsFinish() : int
    {
        return $this->isFinish;
    }
    /**
     * @param mixed $isFinish
     */
    public function setIsFinish($isFinish): void
    {
        $this->isFinish = $isFinish;
    }
    /**
     * @return mixed
     */
    public function getWeek()
    {
        return $this->week;
    }
    /**
     * @param mixed $week
     */
    public function setWeek($week): void
    {
        $this->week = $week;
    }
    public function __construct()
    {
        $this->setIsFinish(0);
        $this->setAwayGoalCount(0);
        $this->setHomeGoalCount(0);
    }
}