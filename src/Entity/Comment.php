<?php


namespace App\Entity;


use Parad0xeSimpleFramework\Core\Http\Entity\AbstractEntity;

class Comment extends AbstractEntity
{
    public static ?string $TABLE = "comments";

    private ?int $id = null;
    private ?string $comment = null;
    private ?int $author_id = null;
    private ?int $post_id = null;
    private ?Author $author = null;
    private ?Post $post = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Comment
     */
    public function setId(?int $id): Comment
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param string|null $comment
     * @return Comment
     */
    public function setComment(?string $comment): Comment
    {
        $this->comment = $comment;
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
     * @return Comment
     */
    public function setAuthorId(?int $author_id): Comment
    {
        $this->author_id = $author_id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPostId(): ?int
    {
        return $this->post_id;
    }

    /**
     * @param int|null $post_id
     * @return Comment
     */
    public function setPostId(?int $post_id): Comment
    {
        $this->post_id = $post_id;
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
     * @return Comment
     */
    public function setAuthor(?Author $author): Comment
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return Post|null
     */
    public function getPost(): ?Post
    {
        return $this->post;
    }

    /**
     * @param Post|null $post
     * @return Comment
     */
    public function setPost(?Post $post): Comment
    {
        $this->post = $post;
        return $this;
    }
}
