<?php
/**
 * Created by PhpStorm.
 * User: gesposito
 * Date: 09/03/19
 * Time: 13:58
 */

namespace Allumina\Playd\Core\Models;

class ACLModel
{
    public function __construct()
    {
        $this->identifier = null;
        $this->read = false;
        $this->write = false;
    }

    public function toJson() {
        return json_encode($this);
    }

    public static function fromJson(string $json) {
        return json_decode($json);
    }
}