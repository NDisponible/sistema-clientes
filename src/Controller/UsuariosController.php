<?php
namespace App\Controller;

use App\Entity\Usuarios;
use App\Repository\UsuariosRepository;
use App\Form\UsuariosType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UsuariosController extends AbstractController
{
    #[Route('/usuarios', name: 'app_usuarios')]
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Usuarios::class);
        $usuarios = $repository->findAll();

        return $this->render('usuarios/index.html.twig', [
            'controller_name' => 'UsuariosController',
            'usuarios' => $usuarios
        ]);
    }
    /**
     * @Route("createUser", name="createUser")
     */
    public function createUser(Request $request) {
        $usuario = new Usuarios();
        $form = $this->createForm(UsuariosType::class, $usuario);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();
            $this->addFlash('notice','Enviado correctamente!');
            return $this->redirectToRoute('app_usuarios');
        }
        return $this->render('usuarios/createUser.html.twig',[
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/updateUser/{id}", name="updateUser")
     */
    public function updateUser(Request $request, $id){
        $usuario = $this->getDoctrine()->getRepository(Usuarios::class)->find($id);
        $form = $this->createForm(UsuariosType::class, $usuario);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();
            $this->addFlash('notice','Modificado correctamente!');
            return $this->redirectToRoute('app_usuarios');
        }
        return $this->render('usuarios/updateUser.html.twig',[
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/deleteUser/{id}", name="deleteUser")
     */
    public function deleteUser($id){
        $data = $this->getDoctrine()->getRepository(Usuarios::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($data);
        $em->flush();
        $this->addFlash('notice','Eliminado correctamente!');
        return $this->redirectToRoute('app_usuarios');
    }
    public function viewUser(Request $request){
        $usuarios = $this->getDoctrine()->getRepository(Usuarios::class)->findAll();  
        return $this->render('usuarios/index.html.twig',[
            'usuarios' => $usuarios
        ]);    
    }
    /**
     * @Route("indexUsuarios", name="indexUsuarios")
     */
    public function indexUsuarios(UsuariosRepository $usuariosRepository, Request $request): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $usuariosRepository->getUsuariosPaginator($offset);

        return $this->render('usuarios/index.html.twig', [
            'usuarios' => $paginator,
            'previous' => $offset - UsuariosRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + UsuariosRepository::PAGINATOR_PER_PAGE),
            'desde' => $offset + 1
        ]);
    }
}