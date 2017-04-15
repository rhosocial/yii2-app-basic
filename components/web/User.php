<?php

/**
 *  _   __ __ _____ _____ ___  ____  _____
 * | | / // // ___//_  _//   ||  __||_   _|
 * | |/ // /(__  )  / / / /| || |     | |
 * |___//_//____/  /_/ /_/ |_||_|     |_|
 * @link https://vistart.me/
 * @copyright Copyright (c) 2016 - 2017 vistart
 * @license https://vistart.me/license/
 */

namespace app\components\web;

use app\models\log\Login;
use rhosocial\user\rbac\roles\Admin;
use Yii;

/**
 * User component.
 *
 * @property-read boolean $isAdmin
 *
 * @version 1.0
 * @author vistart <i@vistart.me>
 */
class User extends \rhosocial\base\models\web\User
{
    public function init()
    {
        parent::init();
        $this->on(static::EVENT_AFTER_LOGIN, [$this, 'onRecordLogon']);
    }
    
    /**
     * 
     * @param \yii\db\Event $event
     */
    public function onRecordLogon($event)
    {
        return $event->sender->identity->recordLogin(['device' => Login::DEVICE_PC_WINDOWS_BROWSER]);
    }

    /**
     * Check whether current identity is administrator or not.
     * @return boolean
     */
    public function getIsAdmin()
    {
        if ($this->getIsGuest()) {
            return false;
        }
        return $this->can((new Admin)->name, $this->identity);
    }
}
