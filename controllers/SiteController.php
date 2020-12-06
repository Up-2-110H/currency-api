<?php

namespace app\controllers;

use app\models\Currency;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use yii\web\Controller;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'currencies'  => ['get'],
                    'currency'  => ['get'],
                ],
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionCurrencies()
    {
        $currenciesQuery = Currency::find();

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $currenciesQuery->count(),
        ]);

        $currencies = $currenciesQuery
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $this->asJson($currencies);
    }

    public function actionCurrency($id=8)
    {
        return $this->asJson(Currency::findOne($id));
    }
}
