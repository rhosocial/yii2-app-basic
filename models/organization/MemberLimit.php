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

/**
 * Class MemberLimit
 * @package app\models
 * @version 1.0
 * @author vistart <i@vistart.me>
 */
class MemberLimit extends \rhosocial\organization\MemberLimit
{
    public $hostClass = Organization::class;
}
