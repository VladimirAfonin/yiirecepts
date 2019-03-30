<?php

namespace frontend\controllers;

use frontend\models\Attribute;
use frontend\models\AttributeValue;
use Yii;
use frontend\models\PProduct;
use frontend\models\search\PProductSearch;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PProductController implements the CRUD actions for PProduct model.
 */
class PProductController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PProduct models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PProduct model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PProduct model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PProduct();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PProduct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $attributeValues = $this->initValues($model);

        $post = Yii::$app->request->post();

        if ($model->load($post) && $model->validate() && Model::loadMultiple($attributeValues, $post) && Model::validateMultiple($attributeValues)) {
            $transaction = PProduct::getDb()->beginTransaction();
            try {
                $model->save(false);
                $this->processValues($attributeValues, $model);
                $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();
                \Yii::$app->session->addFlash('error', $e->getMessage());
                throw $e;
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'attributeValues' => $attributeValues,
            ]);
        }

    }

    /**
     * @param PProduct $model
     * @return array|\yii\db\ActiveRecord[]
     */
    private function initValues(PProduct $model)
    {
        $attributeValues = $model->getAttributeValues()->with('attribute0')->indexBy('attribute_id')->all();
        $attributes = Attribute::find()->indexBy('id')->all();

        foreach (array_diff_key($attributes, $attributeValues) as $attribute) {
            $attributeValues[] = new AttributeValue(['attribute_id' => $attribute->id]);
        }

        foreach ($attributeValues as $value) {
            $value->setScenario(AttributeValue::SCENARIO_PRODUCT);
        }

        return $attributeValues;
    }

    /**
     * @param $attributeValues
     * @param $model
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    private function processValues($attributeValues, $model)
    {
        foreach ($attributeValues as $attributeValue) {
            /** @var AttributeValue $attributeValue */
            $attributeValue->product_id = $model->id;
            if ($attributeValue->validate()) {
                /** @var AttributeValue $attributeValue */
                if (!empty($attributeValue->value)) {

                    $attributeValue->save();
                } else {
                    $attributeValue->delete();
                }
            }
        }
    }

    /**
     * Deletes an existing PProduct model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PProduct::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
