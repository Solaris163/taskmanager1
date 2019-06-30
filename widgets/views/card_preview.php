<?php
use yii\helpers\Url;

/** @var $model \app\models\tables\Tasks */
?>

<a href="<?=Url::to(['task/card', 'id' => $model->id])?>">
    <div>
        <div>Название: <?= $model->name ?></div>
        <div>Описание: <?= $model->description ?></div>
        <div>Ответственный: <?= $model->responsible->user_name ?></div>
        <div>Срок выполнения: <?= $model->deadline ?></div>
    </div>
</a>
