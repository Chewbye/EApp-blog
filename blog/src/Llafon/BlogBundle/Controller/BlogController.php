<?php

namespace Llafon\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class BlogController extends Controller
{
    /**
     * @Route("/", name="blog_homepage")
     */
    public function indexAction()
    {
        return $this->render('LlafonBlogBundle:Blog:index.html.twig');
    }

    /**
     * @Route("/post/{name}", name="blog_postpage")
     */
    public function postAction($name)
    {
        return $this->render('LlafonBlogBundle:Blog:post.html.twig', array('name' => $name));
    }
}
