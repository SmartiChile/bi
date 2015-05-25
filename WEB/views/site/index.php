<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\web\View;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;
$this->title = 'Barrio Italia - '.($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Home' : 'Inicio');
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/shadowbox.css');
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/barrioitalia_fix.css');
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/jqcloud.css');
$this->registerJs('
  Shadowbox.init({}, function() {
  });
');

$this->registerJs(
    '
    $.getJSON("'.Yii::$app->request->baseUrl.'/site/tag?id='.$idioma->pk.'", function(data) {
            var word_array = [
                  
              ];
            $.each(data, function(i, val) {
                word_array.push({text: val.palabra, weight: val.frecuencia, link: "'.Yii::$app->getUrlManager()->createUrl(['site/tiendas', 'lan'=>$idioma->abreviacion, 'b' => '']).'"+val.palabra});
            });
            $("#tagCloud").jQCloud(word_array, {
              height: 330,
            });
    });
'
);
?>

<style type="text/css">
    <?php
        foreach ($circuitos as $circuito) {
            echo ".c_".$circuito->pk.":before{ content:url(".Yii::$app->request->baseUrl."/images/circuitos/".$circuito->icono."); margin: 4.5% 0 0 0;}";
        } 
    ?>

</style>

<div class="site-index">

    <h3 class="h3-movil"><?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? 'CIRCUITS' : 'CIRCUTIOS' ?></h3>

    
    <div class="contenedor-botones">
        <?php
                foreach ($circuitos as $circuito) {
                  $ruta = Url::toRoute(['site/circuito', 'id'=>$circuito->pk, 'lan'=>$idioma->abreviacion]);
                ?>
                <button type="button" onclick="window.location.href='<?php echo $ruta ?>'" style="background-color:<?php echo $circuito->color; ?>" class="btn-circuito btn-circuito-5 btn-circuito-5b c_<?php echo $circuito->pk; ?>"><span><?php echo $circuito->nombre; ?></span></button>
                <?php
                     } 
                ?>
    </div>

    <div class="puntos-separadores no-mostrar"></div>

   <h3 class="no-mostrar"><?= ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? 'SEARCH BAR' : 'BUSCADOR' ?></h3>

   <div class="contenedor-buscador">
      <div class="buscador-home">
        <div class="buscador">
                <?php 
                    $form = ActiveForm::begin([
                        'id' => 'login-form-inline', 
                        'type' => ActiveForm::TYPE_INLINE,
                        'method' => 'get',
                        'action' => Yii::$app->getUrlManager()->createUrl(['site/tiendas']),
                    ]); 
                ?>
                    <?= Html::textInput('b','', ['class'=>'form-control', 'placeholder'=>$idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Keyword' : 'Palabra Clave']) ?>
                    <?= Html::submitButton($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'SEARCH' : 'BUSCAR', ['class' => '']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        <div id="tagCloud"></div>      
        </div>

        <div class="proximos-eventos-home">
            <div class="titulo-proximos-eventos-home">
                <h2><?= $idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Upcoming Events' : 'Próximos Eventos' ?></h2>
            </div>
            <div class="eventos-home">
                <?php
                  if($eventos == null){
                    echo ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en') ? '<p>Sorry , no events have been published yet</p>' : '<p>Lo sentimos, no se han publicado eventos aún.</p>';
                  }
                ?>
                <?php foreach ($eventos as $evento): ?>
                  <div class="cada-evento-home">
                    <div class="nombre-evento-home">
                        <h3><?php echo $evento->titulo; ?> | <?php echo Yii::$app->formatter->asDatetime($evento->inicio, "php:d-m-Y H:i:s") ; ?></h3>
                    </div>
                    <div class="boton-evento-home">
                      <?php echo Html::a('<p>Ver el Calendario Completo</p>', ['site/eventos']); ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

   </div>

   <div class="puntos-separadores no-mostrar"></div>

   <h3 class="no-mostrar"><?= $idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'MAP' : 'MAPA' ?></h3>

   <div class="bg-mapa">
        <?php echo Html::img(Yii::$app->request->baseUrl.'/images/mapa-acc.svg', $options = ['width'=>'100%']); ?>
   </div>

   <div class="puntos-separadores no-mostrar"></div>

   <h3 class="h3-movil"><?= $idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'TOP NEWS' : 'NOTICIAS DESTACADAS' ?></h3>

   <div class="contenedor-noticias-home">

        <?php
          if($noticias == null){
            echo ($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'Sorry , not yet published News' : 'Lo sentimos, no se han registrado noticias aún.');
          }
        ?>

        <?php foreach($noticias as $noticia): ?>
          <div class="noticia-home">
            <?php echo Html::img(Yii::$app->request->baseUrl.'/images/noticias/'.$noticia->imagen, $options = ['width'=>'100%']); ?>
            <div class="mascara">  
            <h2><?php echo $noticia->titulo; ?></h2>
            <?php 
                $descripcion = Yii::$app->funciones->quitarTags($noticia->descripcion);
            ?>  
            <p><?php echo substr($descripcion, 0, 120)."..."; ?></p>
            <?php echo Html::a(($idioma->abreviacion == 'EN' || $idioma->abreviacion == 'en' ? 'More' : 'Leer más'), ['site/noticia', 'id'=>$noticia->pk, 'lan' => $idioma->abreviacion] ,$options = ['class'=>'informacion']); ?>
          </div> 
          </div>
        <?php endforeach; ?>
   </div>
</div>




       