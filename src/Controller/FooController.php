<?php

namespace App\Controller;

use App\Entity\Foo;
use App\Form\FooType;
use App\Repository\FooRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class FooController extends AbstractController
{
    /**
     * @Route("/", name="foo_index", methods={"GET"})
     */
    public function index(FooRepository $fooRepository): Response
    {
        return $this->render('foo/index.html.twig', [
            'foos' => $fooRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="foo_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $foo = new Foo();
        $form = $this->createForm(FooType::class, $foo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($foo);
            $entityManager->flush();

            return $this->redirectToRoute('foo_index');
        }

        return $this->render('foo/new.html.twig', [
            'foo' => $foo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="foo_show", methods={"GET"})
     */
    public function show(Foo $foo): Response
    {
        return $this->render('foo/show.html.twig', [
            'foo' => $foo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="foo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Foo $foo): Response
    {
        $form = $this->createForm(FooType::class, $foo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('foo_index', [
                'id' => $foo->getId(),
            ]);
        }

        return $this->render('foo/edit.html.twig', [
            'foo' => $foo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="foo_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Foo $foo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$foo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($foo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('foo_index');
    }
}
