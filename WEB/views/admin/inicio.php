<?php
/* @var $this yii\web\View */
use kartik\widgets\SideNav;

$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 
$this->title = 'Panel de administración';
$this->params['breadcrumbs'][] = 'Panel de Administración';
?>


<div id="contenedor_panel">
    <div id="sidenav_panel">
        <?= Yii::$app->funciones->menu_panel(); ?>
    </div>
    <div id="contenido_panel">
        Contenido
    </div>
</div>
