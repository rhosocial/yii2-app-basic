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

namespace app\models\organization;

use app\models\OrganizationLimit;

/**
 * Class SubordinateLimit
 * @package app\models\organization
 * @version 1.0
 * @author vistart <i@vistart.me>
 */
class SubordinateLimit extends \rhosocial\organization\SubordinateLimit
{
    public $hostClass = Organization::class;
}
