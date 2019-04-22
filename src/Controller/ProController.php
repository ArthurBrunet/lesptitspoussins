<?php


namespace App\Controller;


use App\Entity\Plan;
use App\Entity\ProProfil;
use App\Form\PlanFormType;
use App\Form\ProProfilFormType;
use App\Repository\PlanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class ProController extends AbstractController
{

    /**
     * @Route("/pro/dashboard/{id}", name="prodashboard")
     */
    public function dashboard(ProProfil $proProfil)
    {

        return $this->render('pro/pro_dashboard.html.twig', [
            'pro' => $proProfil
        ]);
    }

    /**
     * @Route("/pro/{id}/show/planning", name="voirplanning")
     */
    public function showPlanning(ProProfil $proProfil, PlanRepository $planRepository)
    {
        $test = $planRepository->findByPro($proProfil->getId());

        return $this->render('pro/show_planning.html.twig', [
            'test' => $test,
        ]);

    }

    /**
     * @Route("/pro/profil/{id}/edit", name="editproprofil")
     */
    public function editprofil(Request $request, ProProfil $proProfil)
    {
        $form = $this->createForm(ProProfilFormType::class, $proProfil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($proProfil);
            $em->flush();

            return $this->redirectToRoute('prodashboard', [
                'id' => $proProfil->getId()
            ]);
        }

        return $this->render('pro/pro_profil.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/pro/{id}/modifmotdepasse", name="modifpasswordpro")
     */
    public function modifpassword(Request $request, $id, UserPasswordEncoderInterface $encoder)
    {

        if ($request->isMethod("POST"))
        {
            $em = $this->getDoctrine()->getManager();
            $um = $em->getRepository(ProProfil::class)->findOneBy(["id" => $id]);

            $old = $request->request->get('old_password');
            $new = $request->request->get('new_password');
            $confirme = $request->request->get('confirm_new_password');

            if ($encoder->isPasswordValid($um,$old))
            {
                if ($new === $confirme)
                {
                    $um->setPassword($encoder->encodePassword($um, $confirme));

                    $em->flush();

                    $test = $this->addFlash("success", "Votre mot de passe à bien été modifier !");

                    return $this->redirectToRoute("prodashboard",[
                        'id' => $id,
                        'test'=> $test
                    ]);

                }else
                {
                    $this->addFlash("danger", "Erreur de confirmation mot de passe");
                }


            }else{
                $this->addFlash("danger", "Erreur de l'ancien mot de passe");
            }



        }
        return $this->render("parent/modifmdp_parent.html.twig");
    }
    
   /**
     * @Route("/pro/{id}/planning/create", name="creerplanning")
     */
    public function ajoutPlanning(Request $request, ProProfil $proProfil)
    {
        $plan = new Plan();
        $id = $proProfil->getId();
        $form = $this->createForm(PlanFormType::class, $plan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $plan->setProProfil($proProfil);

            $em = $this->getDoctrine()->getManager();
            $em->persist($plan);
            $em->flush();

            $test = $this->addFlash('success', 'Votre planning a bien été ajouté!');

            return $this->redirectToRoute('prodashboard', [
                'id' => $id,
                'test' => $test
            ]);
        }

        return $this->render('pro/formulaire_planning.html.twig', [
            'form' => $form->createView()
        ]);



    }

    /**
     * @Route("/indexpro/calendar/{id}", name="loadcalendar")
     * @return JsonResponse
     */
    public function LoadEvent(PlanRepository $test, $id)
    {


        $evenements = $test->findByPro($id);



        foreach ($evenements as $row){

            $data[] = array(
                'id' => $row['id'],
                'title' => utf8_encode($row['nom'] .' '. $row['prenom']),
                'start' => $row['heuredebut']->format('Y-m-d H:i'),
                'end' => $row['heuredefin']->format('Y-m-d H:i')
            );

        }

        return new JsonResponse($data);

    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {

    }

}
