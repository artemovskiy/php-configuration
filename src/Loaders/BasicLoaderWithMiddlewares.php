<?php
/**
 * Created by PhpStorm.
 * User: xyden
 * Date: 18.07.2018
 * Time: 18:46
 */

namespace Xydens\Configuration\Loaders;


use Xydens\Configuration\Interfaces\Loader;
use Xydens\Configuration\Interfaces\Middleware;

class BasicLoaderWithMiddlewares extends BasicLoader implements Loader {

    /**
     * @var array
     */
    protected $middlewares;

    /**
     * Adds the Middleware to middleware stack
     * The middleware will be run on call load
     *
     * @param Middleware $middleware
     */
    public function addMiddleware(Middleware $middleware){
        $this->middlewares[] = $middleware;
    }

    /**
     * Applies each of $middlewares on $configuration_array
     * @param $configuration_array
     * @return array
     */
    protected function applyMiddlewares($configuration_array){
        return array_reduce($this->middlewares,function($acc,Middleware $middleware){
            return $middleware->run($acc);
        },$configuration_array);
    }

    /**
     * {@inheritdoc}
     */
    public function load() {
        $this->configuration_array = $this->applyMiddlewares($this->content);
    }

}