<?php

namespace Llafon\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="post")
 * @ORM\Entity
 */
class Post {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected $title;
   
    /**
     * @ORM\Column(type="text", nullable=false)
     */
    protected $content;
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $date;   
    
    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $author;
    
    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $image_name;

    public function __construct() {
        $this->date = new \DateTime();
    }
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set content
     *
     * @param string $content
     *
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Post
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    
    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDateString($format = 'Y-m-d H:i:s')
    {
        return $this->date->format($format);
    }

    /**
     * Set author
     *
     * @param integer $author
     *
     * @return Post
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return integer
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set imageName
     *
     * @param integer $imageName
     *
     * @return Post
     */
    public function setImageName($imageName)
    {
        $this->image_name = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return \author
     */
    public function getImageName()
    {
        return $this->image_name;
    }
}
