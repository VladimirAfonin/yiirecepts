<?php

namespace frontend\components;

use yii\filters\AccessRule;
use common\models\User;

class MyAccessRule extends AccessRule
{
    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }
        $isGuest = $user->getIsGuest();
        foreach ($this->roles as $role) {
            switch ($role) {
                case '?':
                    return ($isGuest) ? true : false;
                case User::ROLE_USER;
                    return (!$isGuest) ? true : false;
                case $user->identity->role:
                    return (!$isGuest) ? true : false;
                default:
                    return false;
            }
        }
    }
}