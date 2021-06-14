<?php


namespace App\Controller;


use App\Entity\Author;
use App\Entity\Comment;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use Parad0xeSimpleFramework\Core\ApplicationContext;
use Parad0xeSimpleFramework\Core\Auth\Auth;
use Parad0xeSimpleFramework\Core\Http\Controller\AbstractController;
use Parad0xeSimpleFramework\Core\Request\Request;
use Parad0xeSimpleFramework\Core\Route\Route;
use Parad0xeSimpleFramework\Core\Route\RouteMethod;

class PostCommentController extends AbstractController
{
    public ?array $routes_request_auth = [
        "post:add:comment" => true,
        "post:edit:comment" => true,
        "post:remove:comment" => true
    ];

    /**
     * @var PostRepository
     */
    private PostRepository $_post_repository;

    /**
     * @var CommentRepository
     */
    private CommentRepository $_comment_repository;

    private Author $_author;

    public function __construct(ApplicationContext $context)
    {
        parent::__construct($context);
        $this->_post_repository = new PostRepository($context);
        $this->_comment_repository = new CommentRepository($context);
        $this->_author = $this->_context->auth()->user();
    }

    #[Route("post:add:comment", "/post/:post_id/add/comment", ["post_id" => ["regex" => "\d+"]])]
    #[RouteMethod("post")]
    public function addComment(Request $request, int $post_id)
    {
        $post = $this->_post_repository->find($post_id);

        if(!$post) {
            $request->flash()->push("errors", "Post not found");
            return $this->redirectTo("home:index");
        }

        $comment_content = $request->post()->get("comment");

        if ($request->post()->has("submit")) {
            if ($comment_content) {
                $comment = (new Comment())
                    ->setAuthorId($this->_author->getId())
                    ->setPostId($post->getId())
                    ->setComment($comment_content);

                if($this->_comment_repository->create($comment)) {
                    $request->flash()->push("success", "Comment added successfully");
                    return $this->redirectTo("post:view", ["id" => $post->getId()]);
                }

                return $this->errorResponse(500);
            } else {
                $request->flash()->push("errors", "Missing information");
            }
        }

        return $this->redirectTo("post:view", ['id' => $post->getId()]);
    }

    #[Route("post:edit:comment", "/post/edit/comment/:comment_id", ["comment_id" => ["regex" => "\d+"]])]
    #[RouteMethod("get", "post")]
    public function editComment(Request $request, int $comment_id)
    {
        $comment = $this->_comment_repository->find($comment_id, $this->_author);

        if(!$comment) {
            $request->flash()->push("errors", "Comment not found");
            return $this->redirectTo("home:index");
        }

        $comment_content = $request->post()->get("content", $comment->getComment());

        if ($request->post()->has("submit")) {
            if ($comment_content) {
                $comment->setComment($comment_content);

                if($this->_comment_repository->update($comment)) {
                    $request->flash()->push("success", "Comment updated successfully");
                    return $this->redirectTo("post:view", ["id" => $comment->getPostId()]);
                }

                return $this->errorResponse(500);
            } else {
                $request->flash()->push("errors", "Missing information");
            }
        }

        return $this->render("comment/edit", compact('comment', 'comment_content'));
    }

    #[Route("post:remove:comment", "/post/remove/comment/:comment_id", ["comment_id" => ["regex" => "\d+"]])]
    #[RouteMethod("get")]
    public function removeComment(Request $request, int $comment_id)
    {
        $comment = $this->_comment_repository->find($comment_id, $this->_author);

        if(!$comment)
            return $this->redirectTo("home:index");

        if($this->_comment_repository->delete($comment)) {
            $request->flash()->push("success", "Comment removed successfully");
            return $this->redirectTo("post:view", ["id" => $comment->getPostId()]);
        }

        return $this->errorResponse(500);
    }
}
