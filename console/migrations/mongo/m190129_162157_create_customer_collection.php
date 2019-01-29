<?php

class m190129_162157_create_customer_collection extends \yii\mongodb\Migration
{
    /*public function init()
    {
        $this->db = Yii::$app->mongodb;
        parent::init();
    }*/

    public function up()
    {
        $this->createCollection('customer');
    }

    public function down()
    {
        $this->dropCollection('customer');
    }
}
