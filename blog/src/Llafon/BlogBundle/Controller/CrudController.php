<?php

namespace Llafon\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Llafon\BlogBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Response;

class CrudController extends Controller
{
    /**
     * @Route("/admin", name="crud_homepage")
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()->getRepository('LlafonBlogBundle:Post')->findBy(array(), // Critere
                                                                                        array('date' => 'desc'),        // Tri
                                                                                        5,                              // Limite
                                                                                        0                               // Offset
                                                                                      );

        if (!$posts) {
            throw $this->createNotFoundException('Aucune article trouvé');
        }
        
        return $this->render('LlafonBlogBundle:Blog:index.html.twig', array("posts" => $posts));
    }

    /**
     * @Route("/post/{id}", name="blog_postpage")
     */
    /*
    public function postAction($id)
    {
         $post = $this->getDoctrine()->getRepository('LlafonBlogBundle:Post')->find($id);

        if (!$post) {
            throw $this->createNotFoundException('Aucun article trouvé pour l\'identifiant '.$id);
        }
        return $this->render('LlafonBlogBundle:Blog:post.html.twig', array('post' => $post));
    }
    */
    
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
    }*/
}
