<?php

namespace app\modules\menu;

use Yii;
use yii\base\Module;
use yii\base\BootstrapInterface;

/**
 * menu module definition class
 */
class MenuModule extends Module implements BootstrapInterface
{
    private static $isEventsRun;

    public function bootstrap($app)
    {
        if (self::$isEventsRun === null) {
            if ($app instanceof \yii\console\Application) {
                $this->controllerNamespace = 'app\\modules\\menu\\commands';
            }

            $container = Yii::$container;
            $container->set("app\\modules\\menu\\storages\\interfaces\\INodeStorage", "app\\modules\\menu\\storages\\NodeStorage");
            $this->registerTranslations();
            self::$isEventsRun = true;
        }
    }

    public static function t($message, $params = [], $language = null)
    {
        if(isset(Yii::$app->i18n->translations['menu/*'])) {
            return Yii::t('menu/app', $message, $params, $language);
        }
    }

    private function registerTranslations()
    {
        Yii::$app->i18n->translations[$this->id . '/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@app/modules/' . $this->id . '/messages',
            'sourceLanguage' => 'en-US',
            'forceTranslation' => true,
            'fileMap' => [
                $this->id . '/app' => 'app.php',
            ],
        ];
    }
}