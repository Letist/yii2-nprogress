<?php 

namespace letist\assets;

use yii\helpers\Json;
use yii\web\AssetBundle;

class NprogressAsset extends AssetBundle
{
    public $sourcePath = '@bower/nprogress';

    public $css = [
        'nprogress.css'
    ];

    public $js = [
        'nprogress.js'
    ];

    public $publishOptions = [
        'only'   => [
            '/nprogress.css',
            '/support/extras.css',
            '/nprogress.js',
        ],
    ];

    public $depends = [
        'yii\widgets\PjaxAsset',
        'yii\web\JqueryAsset'
    ];

    public $configuration = null;

    /**
     * Registers the CSS and JS files with the given view.
     * @param \yii\web\View $view the view that the asset files are to be registered with.
     */
    public function registerAssetFiles($view)
    {
        if ($this->configuration !== null) {
            $view->registerJs('NProgress.configure(' . Json::encode($this->configuration) . ');');
        }

        $view->registerJs(<<<JS
jQuery(document).on('pjax:start', function() { NProgress.start(); });
jQuery(document).on('pjax:end',   function() { NProgress.done();  });
JS
);

        $view->registerJs(<<<JS
jQuery(document).on('ajaxStart',    function() { NProgress.start(); });
jQuery(document).on('ajaxComplete', function() { NProgress.done();  });
JS
);

        parent::registerAssetFiles($view);
    }
}
