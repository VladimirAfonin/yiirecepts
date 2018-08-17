<?php

namespace frontend\controllers\shop;

use frontend\forms\CartAddForm;
use shop\ShoppingCart;
use shop\storage\SessionStorage;
use yii\data\ArrayDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use Yii;

class CartController extends Controller
{
    private $_cart;

    public function __construct($id, $module, ShoppingCart $cart, array $config = [])
    {
        $this->_cart = $cart;
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ]
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ArrayDataProvider([
            'allModels' => $this->_cart->getItems(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionAdd()
    {
        $form = new CartAddForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $this->_cart->add($form->productId, $form->amount);
            return $this->redirect(['index']);
        }

        return $this->render('add', ['model' => $form]);
    }

    public function actionDelete($id)
    {
        $this->_cart->remove($id);
        return $this->redirect('index');
    }
}