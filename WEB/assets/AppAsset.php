<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
        'js/jqcloud-1.0.4.min.js',
        'js/justifiedGallery.js',
        'js/jquery.swipebox.min.js',
        'js/jquery.geocomplete.js',
        'js/jquery.bxslider.js',
        'js/shadowbox.js',
        'js/jquery.tooltipster.min.js',
        'js/alert.js',
        'js/dropdown.js',
        'js/modernizr.custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
