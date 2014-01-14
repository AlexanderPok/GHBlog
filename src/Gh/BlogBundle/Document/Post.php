<?php
namespace Gh\BlogBundle\Document;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @MongoDB\Document
 */
class Post
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\String
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @MongoDB\String
     * @Assert\NotBlank()
     * @Assert\Length(min = "100")
     */
    private $text;

    /**
     * @Gedmo\Timestampable(on="create")
     * @MongoDB\Date
     */
    private $created;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Category", simple=true)
     */
    private $category;

//    /**
//     * @MongoDB\EmbedMany(targetDocument="Tag")
//     */
//    private $tags = array();

    /**
     * @MongoDB\Collection
     */
    private $tags = array();

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return self
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Get text
     *
     * @return string $text
     */
    public function getText()
    {
        return $this->text;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }
    
    /**
     * Set created
     *
     * @param date $created
     * @return self
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }


    /**
     * Set category
     *
     * @param Category $category
     * @return self
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get category
     *
     * @return Category $category
     */
    public function getCategory()
    {
        return $this->category;
    }



    /**
     * Set tags
     *
     * @param collection $tags
     * @return self
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * Get tags
     *
     * @return collection $tags
     */
    public function getTags()
    {
        return $this->tags;
    }
}
