<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;

class HelpController extends Controller {

    public function actionManual($id, $id_risk) {
        
        $url_link = Url::to(['riskregister/view', 'id' => $id, 'id_risk' => $id_risk], true);
        
        return $this->render('manual', [
                    'url' => $url_link,
        ]);
    }

}
