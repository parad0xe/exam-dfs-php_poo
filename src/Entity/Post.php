<?php


namespace App\Entity;


use Parad0xeSimpleFramework\Core\Http\Entity\AbstractEntity;

class Post extends AbstractEntity
{
    public static ?string $TABLE = "posts";

    private ?int $id = null;
    private ?int $author_id = null;
    private ?string $title = null;
    private ?string $content = null;
    private ?Author $author = null;

    /**
     * @var Comment[]|null
     */
    private ?array $comments = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Post
     */
    public function setId(?int $id): Post
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAuthorId(): ?int
    {
        return $this->author_id;
    }

    /**
     * @param int|null $author_id
     * @return Post
     */
    public function setAuthorId(?int $author_id): Post
    {
        $this->author_id = $author_id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return Post
     */
    public function setTitle(?string $title): Post
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     * @return Post
     */
    public function setContent(?string $content): Post
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return Author|null
     */
    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    /**
     * @param Author|null $author
     * @return Post
     */
    public function setAuthor(?Author $author): Post
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return Comment[]|null
     */
    public function getComments(): ?array
    {
        return $this->comments;
    }

    /**
     * @param Comment[]|null $comments
     * @return Post
     */
    public function setComments(?array $comments): Post
    {
        $this->comments = $comments;
        return $this;
    }
}
