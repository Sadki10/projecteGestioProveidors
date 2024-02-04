<?php

namespace App\Controller;

use App\Entity\Proveidor;
use App\Form\ProveidorType;
use App\Repository\ProveidorRepository;
use App\Service\ProveidorManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProveidorController extends AbstractController
{
    #[Route('/', name: 'app_llistat_proveidor')]
    public function index(ProveidorRepository $proveidorRepository): Response
    {
        $proveidors = $proveidorRepository->findAll();
        return $this->render('proveidor/llistat.html.twig', [
            'proveidors' => $proveidors,
        ]);
    }
    /* // EntityManager
    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    } */

    #[Route('/crear', name: 'app_crear_proveidor')]
    public function crearProveidor(ProveidorManager $proveidorManager,Request $request): Response
    {
        $proveidor = new Proveidor();
        $form = $this->createForm(ProveidorType::class, $proveidor, ['accio' => 'Crear']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $proveidor->setDataIntroduccio();
            $proveidor->setDataModificacio();

            $telefon = $proveidor->getTelefon();
            $telefon = (str_contains($telefon, '+34')) ? $telefon : '+34' . $telefon ;
            $proveidor->setTelefon($telefon);

            $proveidorManager -> crear($proveidor);
            $this->addFlash('success', 'Proveïdor creat correctament!');
            return $this->redirectToRoute('app_llistat_proveidor');
        }

        return $this->render('proveidor/crear.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/editar/{id}', name: 'app_editar_proveidor')]
    public function editarProveidor(int $id, ProveidorRepository $proveidorRepository,ProveidorManager $proveidorManager,Request $request): Response
    {
        $proveidor = $proveidorRepository->findOneById($id);
        $form = $this->createForm(ProveidorType::class, $proveidor, ['accio' => 'Editar']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $proveidor->setDataModificacio();
            $proveidorManager -> editar($proveidor);
            $this->addFlash('success', 'Proveïdor editat correctament!');
            return $this->redirectToRoute('app_llistat_proveidor');
        }

        return $this->render('proveidor/crear.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/eliminar/{id}', name: 'app_eliminar_proveidor')]
    public function eliminarProveidor(int $id, ProveidorRepository $proveidorRepository,ProveidorManager $proveidorManager,Request $request): Response
    {
        $proveidor = $proveidorRepository->findOneById($id);
        if (null === $proveidor) {
            throw $this->createNotFoundException();
        }

        $proveidorManager -> eliminar($proveidor);
        $this->addFlash('success', 'Proveïdor eliminat correctament!');
        return $this->redirectToRoute('app_llistat_proveidor');
    }
}
