<?php

namespace Llafon\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Llafon\BlogBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class CrudController extends Controller {

    /**
     * @Route("/admin", name="crud_homepage")
     */
    public function listAction(Request $request) {
        empty($request->query->getAlpha('sort')) ? $sort = "date" : $sort = $request->query->getAlpha('sort'); //Récupère la colonne à trier dans la requete
        empty($request->query->getAlpha('direction')) ? $direction = "DESC" : $direction = $request->query->getAlpha('direction'); //Récupère la colonne à trier dans la requete


        $posts = $this->getDoctrine()->getRepository('LlafonBlogBundle:Post')->findBy(array(), // Critere
                array($sort => $direction));

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $posts, $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );

        return $this->render('LlafonBlogBundle:Crud:postsList.html.twig', array('pagination' => $pagination));
    }

    /**
     * @Route("/admin/addpost", name="admin_addpost")
     */
    public function addAction(Request $request) {        
        // On crée un objet Advert
       /* $post = new Post();
        $user = $this->container->get('security.context')->getToken()->getUser();
            $post->setAuthor($user); //l'auteur du post est l'utilisateur connecté
        $post->setContent("zz");
        $post->setImageName("aaa");
        $post->setTitle("fff");
        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
          $em->flush();die();*/
        $post = new Post();
        // On crée le FormBuilder grâce au service form factory
        $formBuilder = $this->get('form.factory')->createBuilder('form', $post);

        // On ajoute les champs de l'entité que l'on veut à notre formulaire
        $formBuilder
                ->add('title', 'text')
                ->add('content', 'textarea')
                ->add('image_name', 'file')
                ->add('save', 'submit')
        ;
       
        // À partir du formBuilder, on génère le formulaire
        $form = $formBuilder->getForm();
        
        //Remplissage de la variable $post avec les infos du formulaire
        $form->handleRequest($request);
        
        // On vérifie que les valeurs entrées sont correctes
        if ($form->isValid()) {
            $user = $this->container->get('security.context')->getToken()->getUser();
            $post->setAuthor($user); //l'auteur du post est l'utilisateur connecté
            
            //Upload de l'image
            $image_name = $user->getId()."_".microtime();
            $post->getImageName()->move($this->container->getParameter("post_images_dir"), $image_name);
            $post->setImageName($image_name);

          // On l'enregistre notre objet $post dans la base de données, par exemple
          $em = $this->getDoctrine()->getManager();
          $em->persist($post);
          $em->flush();

          $request->getSession()->getFlashBag()->add('notice', 'Article bien enregistré.');

          // On redirige vers la page de visualisation de l'annonce nouvellement créée
          return $this->redirectToRoute('crud_homepage');
        }

        // On passe la méthode createView() du formulaire à la vue afin qu'elle puisse afficher le formulaire toute seule
        return $this->render('LlafonBlogBundle:Crud:addPost.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

}
