<?php

namespace console\controllers;

use common\models\User;
use Elasticsearch\Client;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use yii\base\Module;
use yii\console\Controller;

/* @var User $user */
class SearchController extends Controller
{
    private $_client;

    public function __construct(string $id, Module $module, Client $client, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->_client = $client;
    }

    /**
     * reindexing elasticsearch 'user'
     */
    public function actionReindex()
    {
        $query = User::find()->orderBy('id');

        $this->stdout('Clearing' . PHP_EOL);

        try {
            $this->_client->indices()->delete([
                'index' => 'shop'
            ]);
        } catch (Missing404Exception $e) {
            $this->stdout('Index is empty' . PHP_EOL);
        }

        $this->stdout('Indexing of user' . PHP_EOL);

        foreach ($query->all() as $user) {
            $this->stdout('User # ' . $user->getId() . PHP_EOL);

            $this->_client->index([
                'index' => 'shop',
                'type' => 'user',
                'id' => $user->getId(),
                'body' => [
                    'username' => $user->getUserName(),
                    'email' => $user->email,
                    'status' => $user->status,
                ],
            ]);
        }

        $this->stdout('Done!' . PHP_EOL);
    }
}