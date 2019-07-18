<?php

namespace App\Controller;

use App\Entity\Match;
use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ScoreBoardController extends AbstractController
{
    /**
     * @Route("/scores",name="score_board")
     */
    public function index()
    {
        return $this->render('score_board/index.html.twig',['teams' => $this->scoreData()]);
    }
    private function getTeams()
    {
        $repository = $this->getDoctrine()->getRepository(Team::class);
        $teams = $repository->findAll();
        return $teams;
    }
    private function scoreData(){
        $arrayData = [];
        foreach ($this->getTeams() as $team){
            array_push($arrayData,$this->getResult($team));
        }
        return $arrayData;
    }
    private function getResult(Team $team)
    {
        $repository = $this->getDoctrine()->getRepository(Match::class);
        $getMatches = $repository->getTeamMatches($team);
        $matchCount = 0;
        $positiveGoal = 0;
        $negativeGoal = 0;
        $winCount = 0;
        $equalCount = 0;
        $point= 0;
        foreach ($getMatches as $match)
        {
            $matchCount++;
            $home = $match->getHomeGoalCount();
            $away = $match->getAwayGoalCount();
            if($team === $match->getHomeTeam()) {
                $positiveGoal+= $home;
                $negativeGoal += $away;
                if($home > $away){
                    $point+=3;
                    $winCount+=1;
                }
                elseif ($home == $away){
                    $point+=1;
                    $equalCount+=1;
                }
            }
            else {
                $home = $match->getHomeGoalCount();
                $away = $match->getAwayGoalCount();
                $positiveGoal+= $away;
                $negativeGoal += $home;
                if($home < $away){
                    $point+=3;
                    $winCount+=1;
                }elseif ($home == $away){
                    $point+=1;
                    $equalCount+=1;
                }
            }
        }
        $resultData = [
            'name' => $team->getName(),
            'matchCount' => $matchCount,
            'win' => $winCount, 'equal' =>$equalCount, 'lose' => count($getMatches)-($winCount+$equalCount),
            'positiveGoal' => $positiveGoal, 'negativeGoal' => $negativeGoal,
            'average' => $positiveGoal - $negativeGoal,
            'point' => $point
        ];
        return $resultData;
    }
}
