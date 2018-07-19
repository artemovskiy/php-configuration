<?php
/**
 * Created by PhpStorm.
 * User: xyden
 * Date: 19.07.2018
 * Time: 16:28
 */

namespace Xydens\Configuration;


class Helpers {

    public static function reduceIterator(callable $cb, \Iterator $itr, $initial = null) {
        if (is_null($initial)) {
            $initial = $itr->current();
            $itr->next();
        }
        $carry = $initial;
        while ($itr->valid()) {
            $carry = $cb($carry, $itr->current());
            $itr->next();
        }
        $itr->rewind();
        return $carry;
    }

}