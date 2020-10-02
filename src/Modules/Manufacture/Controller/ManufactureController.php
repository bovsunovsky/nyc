<?php

declare(strict_types=1);

namespace App\Modules\Manufacture\Controller;

use App\Modules\Manufacture\Form\ManufactureType;
use App\Modules\Manufacture\Service\ManufactureProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/manufacture")
 */
final class ManufactureController extends AbstractController
{
    private ManufactureProvider $manufactureProvider;

    public function __construct(ManufactureProvider $manufactureProvider)
    {
        $this->manufactureProvider = $manufactureProvider;
    }

    /**
     * @Route("/index", name="app_manufacture")
     */
    public function index(): Response
    {
        $manufacturerList = $this->manufactureProvider->getList();

        return $this->render('manufacture/index.html.twig', [
            'manufactureList' => $manufacturerList,
        ]);
    }

    /**
     * @Route("/create", name="app_create_manufacture", methods={"GET", "POST"})
     */
    public function create(Request $request, ValidatorInterface $validator): Response
    {
        $form = $this->createForm(ManufactureType::class, null, [
            'action' => $this->generateUrl('app_create_manufacture'),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $errors = $form->getErrors();

            if (0 === count($errors)) {
                $this->manufactureProvider->create($form->getData());
            } else {
                foreach ($errors as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
            }

            return $this->redirectToRoute('app_manufacture');
        }

        return $this->render('manufacture/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/update/{id}", name="app_update_manufacture", methods={"GET", "POST"})
     */
    public function update(Request $request, int $id): Response
    {
        $manufacture = $this->manufactureProvider->getById($id);
        $form = $this->createForm(ManufactureType::class, $manufacture, [
            'action' => $this->generateUrl('app_update_manufacture', ['id' => $id]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $errors = $form->getErrors();

            if (0 === count($errors)) {
                $this->manufactureProvider->update($form->getData(), $id);
            } else {
                foreach ($errors as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
            }

            return $this->redirectToRoute('app_manufacture');
        }

        return $this->render('manufacture/update.html.twig', [
            'form' => $form->createView(),
            'manufacture' => $manufacture,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_delete_manufacture", methods={"GET"})
     */
    public function delete(Request $request, int $id): Response
    {
        $this->manufactureProvider->delete($id);

        return $this->redirectToRoute('app_manufacture');
    }
}
