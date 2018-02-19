<?php

namespace Obullo\Router\Loader;

use Obullo\Router\{
    Pipe,
    Route,
    RouteCollection,
    Exception\ParseException,
    Exception\BadRouteException
};
class PhpFileLoader
{
    protected $collection;

    /**
     * Constructor
     * 
     * @param RouteCollection $collection object
     */
    public function __construct(RouteCollection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * Load file
     * 
     * @param string $file file
     */
    public function load(string $file) : RouteCollection
    {
        if (! file_exists($file)) {
            throw new ParseException(
                sprintf('File "%s" does not exist.', $file)
            ); 
        }
        $config = require $file;
        foreach ($config as $name => $route) {
            if (strpos($name, '/') === false) { // routes
                Self::ValidateRoute($name, $route);
                $method = isset($route['method']) ? $route['method'] : 'GET';
                $this->collection->add($name, new Route($method, $route['path'], $route['handler'], Self::getMiddlewares($route)));
            } else {  // pipes
                $pipe = new Pipe($name, Self::getMiddlewares($route));
                unset($route['middleware']);
                $keys = array_keys($route);
                foreach ($keys as $key) {
                    Self::ValidateRoute($key, $route[$key]);
                    $method = isset($route[$key]['method']) ? $route[$key]['method'] : 'GET';
                    $pipe->add($key, new Route($method, $route[$key]['path'], $route[$key]['handler'], Self::getMiddlewares($route[$key])));
                }
                $this->collection->add($pipe);
            }
        }
        return $this->collection;
    }

    /**
     * Returns to array
     * 
     * @param  array  $route route
     * @return array
     */
    protected static function getMiddlewares(array $route) : array
    {
        if (empty($route['middleware'])) {
            return array();
        }
        return (array)$route['middleware'];
    }

    /**
     * Validate route

     * @param  string $name  name
     * @param  array  $route route
     * 
     * @return void
     */
    protected static function validateRoute(string $name, array $route)
    {
        if (empty($name)) {
            throw new BadRouteException('Route name is undefined.');
        }
        if (empty($route['path'])) {
            throw new BadRouteException('Route path is undefined.');
        }
        if (empty($route['handler'])) {
            throw new BadRouteException('Route handler is undefined.');
        }
    }
}