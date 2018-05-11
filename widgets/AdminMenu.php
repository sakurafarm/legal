<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\legal\widgets;

use humhub\modules\legal\models\Page;
use Yii;
use yii\helpers\Url;

class AdminMenu extends \humhub\widgets\BaseMenu
{

    public $template = "@humhub/widgets/views/tabMenu";

    public function init()
    {
        $defaultLanguage = 'en';

        $this->addItem([
            'label' => Yii::t('LegalModule.base', 'Configuration'),
            'url' => Url::to(['/legal/admin']),
            'sortOrder' => 50,
            'isActive' => (Yii::$app->controller->action->id === 'index'),
        ]);

        foreach (Page::getPages() as $key => $pageTitle) {

            $this->addItem([
                'label' => Yii::t('LegalModule.base', $pageTitle),
                'url' => Url::to(['/legal/admin/page', 'pageKey' => $key, 'language' => $defaultLanguage]),
                'sortOrder' => 100,
                'isActive' => (Yii::$app->controller->action->id === 'page' && Yii::$app->request->get('pageKey') == $key),
            ]);
        }

        parent::init();
    }

}
