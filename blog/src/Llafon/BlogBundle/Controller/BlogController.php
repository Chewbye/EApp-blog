<?php

namespace Llafon\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Llafon\BlogBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller {

    /**
     * @Route("/", name="blog_homepage")
     */
    public function indexAction(Request $request) {
        empty($request->query->getAlpha('sort')) ? $sort = "date" : $sort = $request->query->getAlpha('sort'); //Récupère la colonne à trier dans la requete
        empty($request->query->getAlpha('direction')) ? $direction = "DESC" : $direction = $request->query->getAlpha('direction'); //Récupère la colonne à trier dans la requete
        $posts = $this->getDoctrine()->getRepository('LlafonBlogBundle:Post')->findBy(array(), // Critere
                                                                                        array($sort => $direction));

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $posts, $request->query->getInt('page', 1)/* page number */, 3/* limit per page */
        );

        return $this->render('LlafonBlogBundle:Blog:index.html.twig', array('pagination' => $pagination));
    }

    /**
     * @Route("/post/{id}", name="blog_postpage")
     */
    public function postAction($id) {
        $post = $this->getDoctrine()->getRepository('LlafonBlogBundle:Post')->find($id);

        if (!$post) {
            throw $this->createNotFoundException('Aucun article trouvé pour l\'identifiant ' . $id);
        }
        return $this->render('LlafonBlogBundle:Blog:post.html.twig', array('post' => $post));
    }

    /*
      public function createAction(){
      $post = new Post();
      $post->setTitle("Premier post");
      $post->setContent("Contenu premier post");
      $post->setAuthor(1);
      $post->setImageName("test");
      $em = $this->getDoctrine()->getManager();
      $em->persist($post);
      $em->flush();
      } */
}
