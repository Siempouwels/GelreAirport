<?php

class App
{
    protected $controller = 'PageController'; // Default controller
    protected $method = 'index'; // Default method
    protected $requestType = ''; // Request type (GET, POST, etc.)
    protected $params = []; // Parameters
    protected $routes = [
        'login' => 'LoginController@login',
        'logout' => 'LoginController@logout',
        'privacy' => 'PageController@privacy',
    ];

    public function __construct()
    {
        $this->requestType = $_SERVER['REQUEST_METHOD'];
        $url = $this->parseUrl();

        if ($url) {
            $routeKey = implode('/', array_slice($url, 0, 2));
            
            if($routeKey == '') {
                $routeKey = 'index';
            }else if (array_key_exists($routeKey, $this->routes)) {
                $route = explode('@', $this->routes[$routeKey]);
                $this->controller = $route[0];
                $this->method = $route[1];
                $url = array_slice($url, 2);
            } elseif (array_key_exists($url[0], $this->routes)) {
                $route = explode('@', $this->routes[$url[0]]);
                $this->controller = $route[0];
                echo "Controller: " . $this->controller . "\n";
                $this->method = $route[1];
                unset($url[0]);
            } elseif (file_exists('../app/controllers/' . ucfirst(rtrim($url[0], 's')) . 'Controller.php')) {
                // Check for plural forms
                $this->controller = ucfirst(rtrim($url[0], 's')) . 'Controller';
                unset($url[0]);
            } else {
                $this->controller = 'PageController';
                $this->method = 'notFound';
            }
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        if ($url && isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        if (isset($_SERVER['REQUEST_URI'])) {
            $url = explode('/', filter_var(trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'), FILTER_SANITIZE_URL));
            return $url;
        }
        return [];
    }
}
