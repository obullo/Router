<?php

namespace Obullo\Router\Loader;

use Obullo\Router\RouteCollection;

/**
 * Loader interface
 *
 * @copyright Obullo
 * @license   http://opensource.org/licenses/MIT MIT license
 */
interface LoaderInterface
{
    /**
     * Load file
     * 
     * @param string $file file
     */
    public function load(string $file): LoaderInterface;

    /**
     * Returns to route data
     * 
     * @return array
     */
    public function all() : array;

    /**
     * Build collection
     * 
     * @param  RouteCollection $collection collection
     * @return RouteCollection object
     */
    public function build(RouteCollection $collection) : RouteCollection;
}