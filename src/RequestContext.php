<?php

namespace Obullo\Router;

use Psr\Http\Message\RequestInterface as Request;

/**
 * Request context
 *
 * @copyright Obullo
 * @license   http://opensource.org/licenses/MIT MIT license
 */
class RequestContext
{
	protected $path;
	protected $method;
	protected $host;
	protected $scheme;

    /**
     * Updates the RequestContext information based on a Psr\Http\Message\RequestInterface
     *
     * @return $this
     */
    public function fromRequest(Request $request)
    {
        $this->setPath($request->getUri()->getPath());
        $this->setMethod($request->getMethod());
        $this->setHost($request->getUri()->getHost());
        $this->setScheme($request->getUri()->getScheme());
        return $this;
    }

    /**
     * Set path
     * 
     * @param string $path path
     */
    public function setPath($path)
    {
    	$this->path = $path;
    }

    /**
     * Set method
     * 
     * @param method $method method
     */
    public function setMethod($method)
    {
    	$this->method = $method;
    }

    /**
     * Set host
     * 
     * @param host $host host
     */
    public function setHost($host)
    {
    	$this->host = $host;
    }

    /**
     * Set scheme
     * 
     * @param string $scheme scheme
     */
    public function setScheme($scheme)
    {
    	$this->scheme = $scheme;
    }

    /**
     * Returns to path
     * 
     * @return string|null
     */
    public function getPath()
    {
    	return $this->path;
    }

    /**
     * Returns to method
     * 
     * @return string
     */
    public function getMethod()
    {
    	return $this->method;
    }

    /**
     * Returns to host
     * 
     * @return string
     */
    public function getHost()
    {
    	return $this->host;
    }

    /**
     * Returns to scheme
     * 
     * @return string
     */
    public function getScheme()
    {
    	return $this->scheme;
    }
}