<?php
namespace App\Controller;

use App\Entity\Clientes;
use App\Form\ClientesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ClientesController extends AbstractController
{
    #[Route('/clientes', name: 'app_clientes')]
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Clientes::class);
        $clientes = $repository->findAll();
        return $this->render('clientes/index.html.twig', [
            'controller_name' => 'ClientesController',
            'clientes' => $clientes,
        ]);
    }
    /**
     * @Route("create", name="create")
     */
    public function create(Request $request) {
        $client = new Clientes();
        $form = $this->createForm(ClientesType::class, $client);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();
            $this->addFlash('notice','Enviado correctamente!');
            return $this->redirectToRoute('app_clientes');
        }
        return $this->render('clientes/create.html.twig',[
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/update/{id}", name="update")
     */
    public function update(Request $request, $id){
        $client = $this->getDoctrine()->getRepository(Clientes::class)->find($id);
        $form = $this->createForm(ClientesType::class, $client);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();
            $this->addFlash('notice','Modificado correctamente!');
            return $this->redirectToRoute('app_clientes');
        }
        return $this->render('clientes/update.html.twig',[
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete($id){
        $data = $this->getDoctrine()->getRepository(Clientes::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($data);
        $em->flush();
        $this->addFlash('notice','Eliminado correctamente!');
        return $this->redirectToRoute('app_clientes');
    }
    /**
     * @Route("viewClients", name="viewClients")
     */
    public function viewClients(Request $request){
        $clientes = $this->getDoctrine()->getRepository(Clientes::class)->findAll();  
        return $this->render('clientes/viewClients.html.twig',[
            'clientes' => $clientes
        ]);    
    }
    /**
     * @Route("view", name="view")
     */
    public function view(){ 
        return $this->render('clientes/view.html.twig');    
    }
}