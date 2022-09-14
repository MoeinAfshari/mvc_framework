<?php

namespace moeinafshari\phpmvc\form;

use moeinafshari\phpmvc\Model;

class Form
{
    public static function begin($action, $method)
    {
        echo "<form action='{$action}' method='{$method}'>";
        return new Form();
    }

    public static function end()
    {
        echo "</form>";
    }

    public function field(Model $model, $attribute, $type = "text")
    {
        return new InputField($model, $attribute, $type);
    }
}