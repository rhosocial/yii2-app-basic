<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('app', 'About');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= YII_ENV == YII_ENV_DEV ? Yii::t('app', 'This is the About page. You may modify the following file to customize its content:') : ''?>
    </p>

    <code><?= __FILE__ ?></code>
<?php
$markdown = <<<EOT
# Installation

## Database & Connection

Create database & change database connection configuration.

## Migration

You should execute the following migrations:

Create `user`, `profile`, `password_history` tables:

```
yii migrate --migrationPath=@rhosocial/user --migrationNamespaces=rhosocial\\user\\migrations;
```

Create authorization tables:

```
yii migrate --migrationPath=@rhosocial/user --migrationNamespaces=rhosocial\\user\\rbac\\migrations;
```

Create `login_log` table:

```
yii migrate --migrationPath=@rhosocial/user --migrationNamespaces=rhosocial\\user\\models\\log\\migrations;
```

Create organization and it's profile and member tables:

```
yii migrate --migrationPath=@rhosocial/organization --migrationNamespaces=rhosocial\\organization\\migrations;
```

Insert authorization informations about organization:

```
yii migrate --migrationPath=@rhosocial/organization --migrationNamespaces=rhosocial\\organization\\rbac\migrations;
```
EOT;
echo (new \cebe\markdown\GithubMarkdown())->parse($markdown);
?>
</div>
