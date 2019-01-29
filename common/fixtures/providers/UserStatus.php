<?php

namespace common\fixtures\providers;

use Faker\Provider\Base;

class UserStatus extends Base
{
    /**
     * @return mixed
     */
    public function userStatus()
    {
        return $this->randomElement([0, 10, 20, 30]);
    }
}