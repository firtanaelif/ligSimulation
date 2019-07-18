<?php
namespace App\Controller;
use App\Entity\Team;
use App\Entity\Match;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class FixtureController extends AbstractController
{
    /**
     * @Route("/fixture",name="fixture")
     */
    public function index()
    {
        return $this->render('fixture/index.html.twig' , [ 'fixture' => $this->matchesArray()] );
    }
    private function matchesArray()
    {
        $arrayMatches = [];
        for($i = 1 ; $i <= 34 ; $i++){
            $week = $this->getWeek($i);
            $thisWeek = [];
            foreach ($week as $match) {
                $result = [
                    'week' => $match->getWeek(),
                    'home' => $match->getHomeTeam()->getName(),
                    'away' => $match->getAwayTeam()->getName(),
                    'result' => $match->getIsFinish() === 1 ? $match->getHomeGoalCount() . " - " . $match->getAwayGoalCount() : " "];
                array_push($thisWeek,$result);
            }
            array_push($arrayMatches,$thisWeek);
        }
        return $arrayMatches;
    }
    private function getTeams()
    {
        $repository = $this->getDoctrine()->getRepository(Team::class);
        $teams = $repository->findAll();
        return $teams;
    }
    private function getWeek($week)
    {
        $repository = $this->getDoctrine()->getRepository(Match::class);
        return $repository->getWeekMatches($week);
    }
    /**
     * @Route("/create_fixture",name="create_fixture")
     */
    public function createFixture()
    {
        foreach($this->getTeams() as $key=>$team) {
            $randomAway = $this->findRandomTeam($team);
            for ($i = 0 ; $i < 17 ; $i++) {
                $match = new Match();
                $randomAwayTeam = $randomAway[$i];
                $match->setHomeTeam($team)->setAwayTeam($randomAwayTeam)->setWeek($i+1);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($match);
                $entityManager->flush();
                $temp = new Match();
                $temp->setHomeTeam($match->getAwayTeam())
                    ->setAwayTeam($match->getHomeTeam())
                    ->setWeek(($i+1) + 17);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($temp);
                $entityManager->flush();
            }
        }
        return $this->redirect("fixture");
    }
    private function findRandomTeam($randomTeam)
    {
        $arrayMatches = [];
        foreach ($this->getTeams() as $team){
            if($team == $randomTeam){
                continue;
            }
            else{
                array_push($arrayMatches,$team);
            }
        }
        shuffle($arrayMatches);//karıştırmak için
        return $arrayMatches;
    }
    /**
     * @Route("/play",name="play")
     */
    public function play(Request $request)//id kullandım
    {
        // $_GET parameters
        $id = $request->query->get('id');
        // $_POST parameters
        //$id = $request->request->get('id');
        $this->playWeek($id);
        return $this->redirectToRoute("fixture");
    }
    private function playWeek($id)
    {
        $matches = $this->getWeek($id);
        $entityManager = $this->getDoctrine()->getManager();
        foreach ($matches as $match) {
            $match->setIsFinish(1);
            $match->setHomeGoalCount(rand(0, 6));
            $match->setAwayGoalCount(rand(0, 6));
            $entityManager->flush();
        }
    }
}