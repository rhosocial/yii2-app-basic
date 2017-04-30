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

namespace app\migrations;

use app\models\User;
use rhosocial\user\migrations\Migration;
use rhosocial\user\rbac\roles\Admin;
use Yii;

/**
 * Class m170428_133404_CreateWebMaster
 * @package app\migrations
 * @version 1.0
 * @author vistart <i@vistart.me>
 */
class m170428_133404_CreateWebMaster extends Migration
{
    public function up()
    {
        $password = Yii::$app->security->generateRandomString(6);
        $user = new User(['password' => $password]);
        $user->source = 'console_webmaster';
        try {
            $result = $user->register([$user->createProfile(['nickname' => 'vistart'])]);
            if ($result instanceof \Exception) {
                throw $result;
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage() . "\n";
            echo "Failed to register.\n";
        }
        $user->setID('80000000');
        $user->save();
        echo "{$user->getID()} Registered.\n";
        echo "Password: $password\n";

        $assignment = Yii::$app->authManager->assign((new Admin)->name, $user->getGUID());
        if ($assignment) {
            echo "Admin assigned.\n";
        } else {
            echo "Failed to assign Admin role.\n";
        }
    }

    public function down()
    {
        $user = User::find()->andWhere(['source' => 'console_webmaster'])->one();
        try {
            $result = $user->deregister();
            if ($result instanceof \Exception) {
                throw $result;
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage() . "\n";
            echo "Failed to deregister.\n";
        }
        echo "{$user->getID()} Deregistered.\n";
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
