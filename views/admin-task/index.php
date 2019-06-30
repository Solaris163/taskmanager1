<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\filters\TaskFilter */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \Yii::t("app", "admin_panel");
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(\Yii::t("app", "create_task"), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description',
            ['attribute' => 'creator_id', 'header' => \Yii::t("app", "task_creator") . ' ID',],
            ['attribute' => 'responsible_id', 'header' => \Yii::t("app", "task_responsible") . ' ID'],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
