<?php

namespace App\Controller;

use App\Entity\Usuarios;
use App\Repository\UsuariosRepository;
use App\Form\BuscarType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;


class BuscarController extends AbstractController
{
    #[Route('/buscar', name: 'app_buscar')]
    public function index(Request $request, UsuariosRepository $usuariosRepository): Response
    {
        $form = $this->createForm(BuscarType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $idCliente = $form->get('idCliente')->getData();
            $usuarios = $usuariosRepository->findByName($idCliente);
            if(count($usuarios) > 0) {
                return $this->redirectToRoute('buscarCliente', ['idCliente' => $idCliente]);
            } else {
                return $this->render('usuarios/index.html.twig');
            } 
        }
        return $this->render('buscar/index.html.twig', [
            'controller_name' => 'BuscarController',
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/{idCliente/buscarCliente}", name="buscarCliente")
     */
    public function buscarCliente(UsuariosRepository $usuariosRepository, Request $request, Usuarios $usuarios): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $usuariosRepository->getUsuariosByNamePaginator($offset, $usuarios->getIdCliente());

        return $this->render('buscar/buscar_by_name.html.twig', [
            'controller_name' => 'BuscarController',
            'title' => 'Mostrar resultados',
            'h2inner' => 'Registros encontrados',
            'idCliente' => $usuarios->getIdCliente(),
            'usuarios' => $paginator,
            'previous' => $offset - UsuariosRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + UsuariosRepository::PAGINATOR_PER_PAGE),
            'desde' => $offset + 1
        ]);
    }
}
