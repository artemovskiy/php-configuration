<?php
/**
 * Created by PhpStorm.
 * User: xyden
 * Date: 19.07.2018
 * Time: 14:20
 */

namespace Xydens\Configuration\Exceptions;

use Xydens\Configuration\KeyWrapper;


class KeyMissingException extends ConfigurationException {

    /**
     * @var KeyWrapper
     */
    protected $key;

    /**
     * KeyMissingException constructor.
     * @param KeyWrapper $key
     */
    public function __construct($key) {
        $this->key = $key;
        parent::__construct($this->makeMessage(), 500, null);
    }

    protected function makeMessage(){
        return "Key \"{$this->key->current()}\" not found. \r\n Full path: {$this->key->getPath()}";
    }

}