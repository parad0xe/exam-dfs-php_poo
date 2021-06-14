<?php


namespace App\Repository;


use App\Entity\Author;
use App\Entity\Comment;
use App\Entity\Post;
use Parad0xeSimpleFramework\Core\ApplicationContext;
use Parad0xeSimpleFramework\Core\Http\Repository\AbstractRepository;

class CommentRepository extends AbstractRepository
{
    /**
     * @var AuthorRepository
     */
    private AuthorRepository $_author_repository;

    public function __construct(ApplicationContext $context)
    {
        parent::__construct($context, Comment::$TABLE, Comment::class);
        $this->_author_repository = new AuthorRepository($context);
    }

    public function find(int $id, ?Author $author = null): ?Comment
    {
        $query = $this->builder->select("*")
            ->where("id = :id")
            ->setParameter("id", $id);

        if($author) {
            $query->where('author_id = :author_id')
                ->setParameter("author_id", $author->getId());
        }

        $comment = $query->findOne();

        if(!$comment) return null;

        $this->__addAssociatedAuthor($comment);

        return $comment;
    }

    public function findAll(?Post $post = null): array
    {
        $query = $this->builder->select("*");

        if ($post) {
            $query->where("post_id = :post_id")
                ->setParameter("post_id", $post->getId());
        }

        $comments = $query->findAll();

        foreach ($comments as $comment) {
            $this->__addAssociatedAuthor($comment);
        }

        return $comments;
    }

    public function create(Comment &$comment): ?int
    {
        $comment_id = $this->builder->insert('comment', 'author_id', 'post_id')
            ->persist([
                $comment->getComment(),
                $comment->getAuthorId(),
                $comment->getPostId()
            ]);

        if (!$comment_id) return null;

        $comment->setId($comment_id);

        return $comment_id;
    }

    public function update(Comment &$comment): bool
    {
        return $this->builder->update('comment')
            ->where("id = :id")
            ->setParameter("id", $comment->getId())
            ->persist([
                $comment->getComment()
            ]);
    }

    public function delete(Comment &$comment): bool
    {
        return $this->builder->delete()
            ->where("id = :id")
            ->setParameter("id", $comment->getId())
            ->execute();
    }

    private function __addAssociatedAuthor(Comment &$comment): void
    {
        $author = $this->_author_repository->find($comment->getAuthorId());
        $comment->setAuthor($author);
    }
}
