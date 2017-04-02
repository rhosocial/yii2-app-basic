<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
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
yii migrate --migrationPath=@rhosocial/user --migrationNamespace=rhosocial\user\migrations;
```

Create authorization tables:

```
yii migrate --migrationPath=@rhosocial/user --migrationNamespace=rhosocial\user\\rbac\migrations;
```

Create `login_log` table:

```
yii migrate --migrationPath=@rhosocial/user --migrationNamespace=rhosocial\user\models\log\migrations;
```

Create organization and it's profile and member tables:

```
yii migrate --migrationPath=@rhosocial/organization --migrationNamespace=rhosocial\organization\migrations;
```

Create organization authorization tables:

```
yii migrate --migrationPath=@rhosocial/organization --migrationNamespace=rhosocial\organization\\rbac\migrations;
```
EOT;
echo (new \cebe\markdown\GithubMarkdown())->parse($markdown);
?>
</div>
