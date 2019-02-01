<?php

namespace frontend\components;

use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\base\InvalidParamException;
use yii\caching\Cache;
use yii\di\Instance;
use yii\helpers\Json;


class Exchange extends Component
{
    public $host = 'http://data.fixer.io/api/convert?access_key=61cda6350e1f790883ffe56083e81836';
    public $enableCaching = false;
    /* @var Cache $cache*/
    public $cache = 'cache';

    public function init()
    {
        if(empty($this->host)) {
            throw new InvalidConfigException('Host must be set.');
        }

        if($this->enableCaching) {
            $this->cache = Instance::ensure($this->cache, Cache::class);
        }
        parent::init();
    }

    public function getRate($source, $destination, $amount, $date = null)
    {
        $this->validateCurrency($source);
        $this->validateCurrency($destination);
        $date = $this->validateDate($date);

        $cacheKey = $this->generateCacheKey($source, $destination, $date);

        if(!$this->enableCaching || ($result = $this->cache->get($cacheKey)) === false) {
            $result = $this->getRemoteRate($source, $destination, $amount, $date);
            if ($this->enableCaching) {
                $this->cache->set($cacheKey, $result);
            }
        }
        return $result;
    }

    private function getRemoteRate($source, $destination,$amount,  $date)
    {
        $url = $this->host . '&from=' . $source . '&to=' . $destination . '&amount=' . $amount . '&date=' . $date;
        $response = Json::decode(file_get_contents($url));

        die($response);
        if(!isset($response['query']['to'][$destination])) {
            throw new \RuntimeException('Rate not found.');
        }
        return $response['result'];
    }

    private function validateCurrency($source)
    {
        if (!preg_match('#^[A-Z]{3}$#s', $source)) {
            throw new InvalidParamException('Invalid currency format.');
        }
    }

    private function validateDate($date)
    {
        if (!empty($date) && !preg_match('#\d{4}\-\d{2}-\d{2}#s', $date)) {
            throw new InvalidParamException('Invalid date format.');
        }
        if (empty($date)) {
            $date = date('Y-m-d');
        }
        return $date;
    }

    private function generateCacheKey($source, $destination, $date)
    {
        return [__CLASS__, $source, $destination, $date];
    }
}