CALL yii migrate --migrationPath=@rhosocial/user --migrationNamespaces=rhosocial\user\migrations --interactive=0
CALL yii migrate --migrationPath=@rhosocial/user --migrationNamespaces=rhosocial\user\rbac\migrations --interactive=0
CALL yii migrate --migrationPath=@rhosocial/user --migrationNamespaces=rhosocial\user\models\log\migrations --interactive=0
CALL yii migrate --migrationPath=@rhosocial/user --migrationNamespaces=rhosocial\user\models\migrations --interactive=0
CALL yii migrate --migrationPath=@rhosocial/organization --migrationNamespaces=rhosocial\organization\migrations --interactive=0
CALL yii migrate --migrationPath=@rhosocial/organization --migrationNamespaces=rhosocial\organization\rbac\migrations --interactive=0
CALL yii migrate --migrationPath=@app --migrationNamespaces=app\migrations --interactive=0
