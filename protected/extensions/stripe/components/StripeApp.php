<?php

require_once Yii::getPathOfAlias('application.components.Stripe.lib') . '/Stripe.php';

class StripeApp extends CApplicationComponent
{
    public $secret;
    public $publish;

    protected $_assetsUrl;

    public function init()
    {
        Stripe::setApiKey($this->secret);
        $this->registerJavaScript();
        parent::init();
    }

    public function registerJavaScript()
    {
        $this->setPublishKey();
        cs()->registerScriptFile('https://js.stripe.com/v2/', CClientScript::POS_HEAD);
        cs()->registerScriptFile($this->getAssetsUrl() . DIRECTORY_SEPARATOR . 'jquery.payment.js');
        cs()->registerScriptFile($this->getAssetsUrl() . DIRECTORY_SEPARATOR . 'paymentHandler.js');
    }

    protected function getAssetsUrl() {
        if (isset($this->_assetsUrl)) {
            return $this->_assetsUrl;
        } else {
            $assetsPath = Yii::getPathOfAlias('ext.stripe.assets');
            $assetsUrl = app()->assetManager->publish($assetsPath, false, -1, YII_DEBUG);
            return $this->_assetsUrl = $assetsUrl;
        }
    }


    private function setPublishKey()
    {
        cs()->registerScript('stripe-publishKey', "Stripe.setPublishableKey('{$this->publish}');", CClientScript::POS_HEAD);
    }
}