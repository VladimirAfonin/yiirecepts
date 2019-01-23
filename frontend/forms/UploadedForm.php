<?php

namespace frontend\forms;

use yii\base\Model;
use yii\captcha\Captcha;
use yii\web\UploadedFile;

class UploadedForm extends Model
{
    /** @var UploadedFile */
//    public $file;
    public $imageFiles;

    public $verifyCode;

    /**
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public function rules()
    {
        return [
//            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'txt'],
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
            [['verifyCode'], 'captcha', 'skipOnEmpty' => !Captcha::checkRequirements(), 'captchaAction' => 'site/captcha']
        ];
    }

    /**
     * @return bool
     */
    public function upload()
    {
        if ($this->validate()) {
//            $this->file->saveAs('uploads/' . $this->file->baseName . '.' . $this->file->extension);
            foreach ($this->imageFiles as $file) {
                /** @var UploadedFile $file */
                $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
}