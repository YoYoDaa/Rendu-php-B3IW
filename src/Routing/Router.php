<?php

namespace App\Routing;

use App\Routing\Exception\RouteNotFoundException;
use Psr\Container\ContainerInterface;

class Router
{
    /** @var Route[] */
    private array $routes = [];

    public function __construct(
        private ContainerInterface $container
    ) {
    }

    public function addRoute(Route $route): self
    {
        // TODO: Gestion doublon
        $this->routes[] = $route;
        return $this;
    }

    public function getRoute(string $uri, string $httpMethod): ?Route
    {
        foreach ($this->routes as $savedRoute) {
            if ($savedRoute->getUri() === $uri && $savedRoute->getHttpMethod() === $httpMethod) {
                return $savedRoute;
            }
        }

        return null;
    }

    /**
     * Executes a route against given URI and HTTP method
     *
     * @param string $uri
     * @param string $httpMethod
     * @return void
     * @throws RouteNotFoundException
     */
    public function execute(string $uri, string $httpMethod): string
    {
        $route = $this->getRoute($uri, $httpMethod);

        if ($route === null) {
            throw new RouteNotFoundException();
        }

        // Constructeur
        $controllerClass = $route->getControllerClass();
        $constructorParams = $this->getMethodParams($controllerClass . '::__construct');
        $controllerInstance = new $controllerClass(...$constructorParams);

        // Contrôleur
        $method = $route->getController();
        $controllerParams = $this->getMethodParams($controllerClass . '::' . $method);
        return $controllerInstance->$method(...$controllerParams);
    }

    private function getMethodParams(string $method): array
    {
        $methodInfos = new \ReflectionMethod($method);
        $methodParameters = $methodInfos->getParameters();

        $params = [];
        foreach ($methodParameters as $param) {
            $paramType = $param->getType();
            $paramTypeFQCN = $paramType->getName();
            $params[] = $this->container->get($paramTypeFQCN);
        }

        return $params;
    }
}