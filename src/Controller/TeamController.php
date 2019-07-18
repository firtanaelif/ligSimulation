<?php

namespace App\Controller;

use App\Entity\Team;
use App\Form\CreateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{
    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $team = new Team();
        $form = $this->createFormBuilder($team)
            ->add('name', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Takım Oluşturunuz...'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $team = new Team();
            $team->setName($form['name']->getData());
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($team);
            $manager->flush();
        }
        return $this->render('create/index.html.twig', array(
            'form'=>$form->createView(),
            'teams' => $this->getTeams(),
            'teamCount' => count($this->getTeams())
        ));
    }
    private function getTeams(){
        $repository = $this->getDoctrine()->getRepository(Team::class);
        $teams = $repository->findAll();
        return $teams;
    }
}
