<?php


namespace App\Repository;


use App\Entity\Author;
use App\Entity\Post;
use Parad0xeSimpleFramework\Core\ApplicationContext;
use Parad0xeSimpleFramework\Core\Http\Repository\AbstractRepository;

class PostRepository extends AbstractRepository
{
    /**
     * @var AuthorRepository
     */
    private AuthorRepository $_author_repository;

    /**
     * @var CommentRepository
     */
    private CommentRepository $_comment_repository;

    public function __construct(ApplicationContext $context)
    {
        parent::__construct($context, Post::$TABLE, Post::class);
        $this->_author_repository = new AuthorRepository($context);
        $this->_comment_repository = new CommentRepository($context);
    }

    public function find(int $id, ?Author $author = null): ?Post
    {
        /** @var Post $post */
        $builder = $this->builder->select("*")
            ->where("id = :id")
            ->setParameter("id", $id);

        if ($author) {
            $builder->where("author_id = :author_id")
                ->setParameter("author_id", $author->getId());
        }

        $post = $builder->findOne();

        if (!$post) return null;

        $this->__addAssociatedAuthor($post);
        $this->__addAssociatedComments($post);

        return $post;
    }

    public function findAll(): array
    {
        $posts = $this->builder
            ->select("*")
            ->findAll();

        foreach ($posts as $post) {
            $this->__addAssociatedAuthor($post);
            $this->__addAssociatedComments($post);
        }

        return $posts;
    }

    public function create(Post &$post): ?int
    {
        $id = $this->builder->insert("author_id", "title", "content")->persist([
            $post->getAuthorId(),
            $post->getTitle(),
            $post->getContent()
        ]);

        if (!$id) return null;

        $post->setId($id);

        return $id;
    }

    public function update(Post &$post): bool
    {
        if($post->getId() === null) return false;

        return $this->builder->update("title", "content")
            ->where("id = :id")
            ->setParameter("id", $post->getId())
            ->persist([
                $post->getTitle(),
                $post->getContent()
            ]);
    }

    public function delete(Post &$post): bool
    {
        return $this->builder->delete()
            ->where("id = :id")
            ->setParameter("id", $post->getId())
            ->execute();
    }

    private function __addAssociatedAuthor(Post &$post): void
    {
        $author = $this->_author_repository->find($post->getAuthorId());
        $post->setAuthor($author);
    }

    private function __addAssociatedComments(Post &$post): void
    {
        $comments = $this->_comment_repository->findAll($post);
        $post->setComments($comments);
    }
}
