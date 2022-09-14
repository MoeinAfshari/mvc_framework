<?php

namespace moeinafshari\phpmvc;

use moeinafshari\phpmvc\db\DbModel;

abstract class UserModel extends DbModel
{
    abstract public function getDisplayName() : string;
}