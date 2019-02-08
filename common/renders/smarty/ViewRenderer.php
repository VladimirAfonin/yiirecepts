<?php

namespace common\renders\smarty;

use Smarty;

class ViewRenderer extends \yii\base\ViewRenderer
{
    public $cachePath = '@common/runtime/smarty/cache';
    public $compilePath = '@common/runtime/smarty/compile';


    /**
     * @var $smarty Smarty
     */
    private $smarty;


    public function init()
    {
        $this->smarty = new Smarty();

        $this->smarty->setCompileDir(\Yii::getAlias($this->compilePath));
        $this->smarty->setCacheDir(\Yii::getAlias($this->cachePath));
        $this->smarty->setTemplateDir([
            dirname(\Yii::$app->getView()->getViewFile()),
            \Yii::$app->getViewPath(),
        ]);
    }

    /**
     * @param \yii\base\View $view
     * @param string $file
     * @param array $params
     * @return mixed
     */
    public function render($view, $file, $params)
    {
       $templateParams = empty($params) ? null : $params;
       $template = $this->smarty->createTemplate($file, null, null, $templateParams, false);
       $template->assign('app', \Yii::$app);
       $template->assign('this', $view);
       return $template->fetch();
    }
}