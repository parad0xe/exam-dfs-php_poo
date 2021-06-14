<?php


namespace App\Controller;


use App\Repository\AuthorRepository;
use Parad0xeSimpleFramework\Core\ApplicationContext;
use Parad0xeSimpleFramework\Core\Auth\Auth;
use Parad0xeSimpleFramework\Core\Request\Request;
use Parad0xeSimpleFramework\Core\Route\Route;
use Parad0xeSimpleFramework\Core\Route\RouteMethod;
use Parad0xeSimpleFramework\Core\Http\Controller\AbstractController;

class AuthController extends AbstractController
{
    public ?array $routes_request_auth = [
        "auth:login" => false,
        "auth:logout" => true
    ];

    private AuthorRepository $_author_repository;

    /**
     * HomeController constructor.
     * @param ApplicationContext $context
     */
    public function __construct(ApplicationContext $context)
    {
        parent::__construct($context);
        $this->_author_repository = new AuthorRepository($context);
    }

    #[Route("auth:login", "/login")]
    #[RouteMethod("get", "post")]
    public function login(Request $request, Auth $auth) {
        $email = $request->post()->get("email");
        $password = $request->post()->get("password");

        if($request->post()->has("submit")) {
            if($email && $password) {
                $author = $this->_author_repository->retrieve($email, $auth->hashPassword($password));

                if($author) {
                    $author->setPassword(null);
                    $auth->login($author);
                    $request->flash()->push("success", "Login successfully");
                    return $this->redirectTo("home:index");
                }

                $request->flash()->push("errors", "Invalid credentials");
            } else {
                $request->flash()->push("errors", "Missing information");
            }
        }

        return $this->render("auth/login", [
            "email" => $email ?? ""
        ]);
    }

    #[Route("auth:logout", "/logout")]
    public function logout(Request $request, Auth $auth) {
        $auth->logout();
        $request->flash()->push("success", "Logout successfully");
        return $this->redirectTo("auth:login");
    }
}
