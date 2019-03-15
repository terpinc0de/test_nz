# Модуль для работы с меню

## Установка
* Скопируйте модуль в @app/modules
* Установите пакет для работы с Nested Sets
    composer require creocoder/yii2-nested-sets
* зарегистрируйте модуль в конфигах:
```php
// web.php
'bootstrap' => [
    // ...
    'menu',
],
'modules' => [
    // ...
    'menu' => [
        'class' => 'app\\modules\\menu\\MenuModule',
        'controllerNamespace' => 'app\\modules\\menu\\controllers\\backend',
        'viewPath' => '@app/modules/menu/views/backend',
    ],
],

// console.php
'bootstrap' => [
    // ...
    'menu',
],

'controllerMap' => [
    // ...
    'migrate-menu' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationNamespaces' => ['app\modules\menu\migrations'],
        'migrationTable' => 'migration_menu',
    ],
],

'modules' => [
    // ...
    'menu' => [
        'class' => 'app\\modules\\menu\\MenuModule',
    ],
],
```
* Примените миграцию
    yii migrate-menu
* С помощью консольной команды создайте корневой узел:
    yii menu/init/create-root

## Использование
Страница с деревом должна быть доступна по адресу:
/menu/default/index
Создайте узлы первого уровня вложенности с помощью кнопки "Создать пункт".
Каждый узел имеет кнопки "Добавить", "Редактировать", "Удалить". Воспользуйтесь ими для модификации дерева.