Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist contrib/yii2-metatag "*"
```

or add

```
"contrib/yii2-metatag": "*"
```

to the require section of your `composer.json` file.

Configure
---------

backend:

```
    'modules' => [
        'metatag' => [
            'class' => \tina\metatag\Module::class,
            'viewPath' => '@vendor/contrib/yii2-metatag/views/backend',
            'controllerNamespace' => 'tina\metatag\controllers\backend',
        ],
    ],
```

params:

```
    'menu' => [
        [
            'label' => 'Main page',
            'items' => [
                [
                    'label' => 'Metatag',
                    'url' => ['/metatag/default'],
                ],
            ],

        ],
    ],
```

console:

```
    'migrate' => [
        'class' => \yii\console\controllers\MigrateController::class,
        'migrationTable' => '{{%migration}}',
        'interactive' => false,
        'migrationPath' => [
            '@vendor/contrib/yii2-metatag/migrations',
        ],
    ],
```

...

```
    'config' => [
        [
            'name' => 'metatag',
            'controllers' => [
                'default' => [
                    'update',
                ],
            ],
        ],
    ],
```

Use:
----

Model.php

```
    public $meta;

    public function behaviors()
    {
        return [
            'MetatagBehavior' => [
                'class' => MetatagBehavior::class,
                'metaAttribute' => 'meta',
            ],
        ];
    }
```

Frontend:

index.php

```
MetatagWidget::widget([
    'model' => $model->meta,
    'isIndex' => true,
    'pageTitle' => $dto->getTitle(),
]); 

```
page.php

```
MetatagWidget::widget([
    'model' => $model->meta,
    'pageTitle' => $dto->getTitle(),
]);

```

Backend:

_form.php

```
<?= MetatagWidget::widget([
    'model' => $model->meta,
    'form' => $form,
]) ?>

```

view.php

```
    <div class="card-content">
        <?= MetatagViewWidget::widget([
            'model' => $model->meta,
        ]) ?>
    </div>

```
