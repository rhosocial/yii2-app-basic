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

namespace app\models;

use rhosocial\organization\UserOrganizationTrait;
/**
 * @version 1.0
 * @author vistart <i@vistart.me>
 */
class User extends \rhosocial\user\User
{
    use UserOrganizationTrait;
    public $profileClass = Profile::class;
    public $passwordHistoryClass = \rhosocial\user\security\PasswordHistory::class;
    public $searchClass = UserSearch::class;
    public $loginLogClass = log\Login::class;
    public function init()
    {
        $this->organizationClass = organization\Organization::class;
        $this->organizationLimitClass = OrganizationLimit::class;
        $this->initOrganizationEvents();
        parent::init();
    }
}
