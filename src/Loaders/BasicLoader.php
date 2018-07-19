<?php
/**
 * Created by PhpStorm.
 * User: xyden
 * Date: 18.07.2018
 * Time: 18:46
 */

namespace Xydens\Configuration\Loaders;


use Xydens\Configuration\Interfaces\Loader;

class BasicLoader implements Loader {

    /**
     * @var array
     */
    protected $content;

    /**
     * @var array
     */
    protected $configuration_array;

    /**
     * {@inheritdoc}
     */
    public function getConfigurationArray() {
        return $this->configuration_array;
    }

    /**
     * {@inheritdoc}
     */
    public function load() {
        $this->configuration_array = $this->content;
    }

    /**
     * @return array
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * @param array $content
     */
    public function setContent($content) {
        $this->content = $content;
    }
}