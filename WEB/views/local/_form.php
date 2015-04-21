<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;

/* @var $this yii\web\View */
/* @var $model app\models\Local */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFile(Yii::$app->request->baseUrl.'/css/panel.css'); 
$this->registerJs('
    $(function(){
        $("#local-direccion").geocomplete()
          .bind("geocode:result", function(event, result){
				$("#local-coordenadas").val("(" + result.geometry.location.lat() + "," + result.geometry.location.lng() + ")");
                $("#latlng").val("(" + result.geometry.location.lat() + "," + result.geometry.location.lng() + ")");
				$("#local-coordenadas").prop("disabled", false);
                setMarcador(result.geometry.location.lat(),result.geometry.location.lng());
          });
      });

    $("#latlng_manual").change(function () {
        if ($(this).val() == 0) {
            $("#latlng").prop("readonly", true);
            return;
        }
        $("#latlng").prop("readonly", false);
    });
    
    $("#w0").click(function(e) {  
         $("#latlng").val($("#local-coordenadas").val());
    });
    
');
	
?>
<script>
      var map;
	  var markers = [];
function setMarcador(lat,lng) {
	  var location = new google.maps.LatLng(lat, lng);
	  var mapOptions = {
	    zoom: 16,
	    center: new google.maps.LatLng(lat, lng)
	  };
	  map = new google.maps.Map(document.getElementById('w0'),mapOptions);
	  var marker = new google.maps.Marker({
	    position: location,
	    map: map
	  });
	  markers.push(marker);

}

</script>
<div id="contenedor_panel">
    <div id="sidenav_panel">
        <?= Yii::$app->funciones->menu_panel(); ?>
    </div>
    <div id="contenido_panel">

        <h1><?= $model->isNewRecord ? 'Crear Local' : 'Modificar Local ' . '<b>"'.$model->direccion.'"</b>' ?></h1>

        <hr />

         <?php 
            $form = ActiveForm::begin([
                'id' => 'login-form-horizontal', 
                'options'=>['enctype'=>'multipart/form-data'],
                'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
            ]); 
        ?>

		<?= $form->field($model, 'direccion')->textInput(['maxlength' => 255]) ?>

    	<?= $form->field($model, 'coordenadas')->widget('kolyunya\yii2\widgets\MapInputWidget',[

    		'latitude' => -33.445067,
    		'longitude' => -70.6254111,
    		'zoom' => 16,
    		'animateMarker' => true,

    	]); ?>

        <div class="form-group field-local-coordenadas2">
        <label class="col-sm-3 control-label" for="usuario-password">(Latitud,Longitud)</label>
            <div class="col-sm-9">
                <?= Html::textInput('coordenadas2','', ['class'=>'form-control w40', 'id'=>'latlng', 'readonly'=>true]) ?>
                <i>Activar Ingreso de coordenadas manual</i>
                <?= CheckboxX::widget([
                    'name'=>'latlng_manual',
                    'options'=>['id'=>'latlng_manual'],
                    'pluginOptions'=>['threeState'=>false, 'size'=>'sm'],
                ]);?>
            </div>
        </div>

        <div class="form-group botones-panel">
            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-primary ' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
