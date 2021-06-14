<?php


namespace App\Controller;

use App\Repository\PostRepository;
use Exception;
use Parad0xeSimpleFramework\Core\ApplicationContext;
use Parad0xeSimpleFramework\Core\Route\Route;
use Parad0xeSimpleFramework\Core\Route\RouteMethod;
use Parad0xeSimpleFramework\Core\Http\Controller\AbstractController;

class HomeController extends AbstractController
{
    public ?array $routes_request_auth = [
        "home:index" => true
    ];

    private PostRepository $_post_repository;

    /**
     * HomeController constructor.
     * @param ApplicationContext $context
     * @throws Exception
     */
    public function __construct(ApplicationContext $context)
    {
        parent::__construct($context);
        $this->_post_repository = new PostRepository($context);
    }

    #[Route("home:index", "/home")]
    public function index() {
        $posts = $this->_post_repository->findAll();

        return $this->render("home/index", [
            "posts" => $posts
        ]);
    }
}
