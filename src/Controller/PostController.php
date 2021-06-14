<?php


namespace App\Controller;


use App\Entity\Author;
use App\Entity\Post;
use App\Repository\PostRepository;
use Parad0xeSimpleFramework\Core\ApplicationContext;
use Parad0xeSimpleFramework\Core\Auth\Auth;
use Parad0xeSimpleFramework\Core\Http\Controller\AbstractController;
use Parad0xeSimpleFramework\Core\Request\Request;
use Parad0xeSimpleFramework\Core\Route\Route;
use Parad0xeSimpleFramework\Core\Route\RouteMethod;

class PostController extends AbstractController
{
    public ?array $routes_request_auth = [
        "post:view" => true,
        "post:create" => true,
        "post:update" => true,
        "post:delete" => true
    ];

    /**
     * @var PostRepository
     */
    private PostRepository $_post_repository;

    private Author $_author;

    public function __construct(ApplicationContext $context)
    {
        parent::__construct($context);
        $this->_post_repository = new PostRepository($context);
        $this->_author = $this->_context->auth()->user();
    }

    #[Route("post:view", "/post/view/:id", ["id" => ["regex" => "\d+"]])]
    public function view(int $id) {
        $post = $this->_post_repository->find($id);

        if(!$post)
            return $this->errorResponse(404);

        return $this->render("post/view", compact("post"));
    }

    #[Route("post:create", "/post/create")]
    #[RouteMethod("get", "post")]
    public function create(Request $request) {
        $title = $request->post()->get("title", "");
        $content = $request->post()->get("content", "");

        if($request->post()->has("submit")) {
            if($title && $content) {
                $post = (new Post())
                    ->setTitle($title)
                    ->setContent($content)
                    ->setAuthor($this->_author)
                    ->setAuthorId($this->_author->getId());

                if($this->_post_repository->create($post)) {
                    $request->flash()->push("success", "Post created successfully");
                    return $this->redirectTo("post:view", ["id" => $post->getId()]);
                }

                return $this->errorResponse(500);
            } else {
                $request->flash()->push("errors", "Missing information");
            }
        }

        return $this->render("post/create", compact("title", "content"));
    }

    #[Route("post:update", "/post/:id/update", ["id" => ["regex" => "\d+"]])]
    #[RouteMethod("get", "post")]
    public function update(Request $request, int $id) {
        $post = $this->_post_repository->find($id, $this->_author);

        if(!$post) {
            $request->flash()->push("errors", "Post not found");
            return $this->redirectTo("home:index");
        }

        $title = $request->post()->get("title", $post->getTitle());
        $content = $request->post()->get("content", $post->getContent());

        if($request->post()->has("submit")) {
            if($title && $content) {
                $post->setTitle($title);
                $post->setContent($content);

                if($this->_post_repository->update($post)) {
                    $request->flash()->push("success", "Post updated successfully");
                    return $this->redirectTo("post:view", ["id" => $post->getId()]);
                }

                return $this->errorResponse(500);
            } else {
                $request->flash()->push("errors", "Missing information");
            }
        }

        return $this->render("post/update", compact("post", "title", "content"));
    }

    #[Route("post:delete", "/post/:id/delete", ["id" => ["regex" => "\d+"]])]
    public function delete(Request $request, int $id) {
        $post = $this->_post_repository->find($id, $this->_author);

        if(!$post) {
            $request->flash()->push("errors", "Post not found");
            return $this->redirectTo("home:index");
        }

        if($this->_post_repository->delete($post)) {
            $request->flash()->push("success", "Post deleted successfully");
            return $this->redirectTo("home:index");
        }

        $request->flash()->push("errors", "An error occurred");
        return $this->redirectTo("post:view", ['id' => $post->getId()]);
    }
}
