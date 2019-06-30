<?php

use yii\widgets\ActiveForm;

echo "<h4>Этот сайт создан с помощью Yii2. Здесь можно создавать, просматривать, редактировать задачи. К задаче можно 
оставлять комментарии и изображения. Изображения сохраняются в уменьшенном виде и в оригинале. Есть главная страница
со списком задач, и страница с карточкой выбранной задачи. Также есть автоматически сгенерированная админка.
Редактировать задачу можно как из карточки задачи, так и из админки. Есть возможность выбора языка.</h4>";

echo "<h4>Для авторизации используйте этих пользователей: boss, proger, designer. Пароль 123.</h4>";

echo "<h4>Это страница со всеми задачами. Она выводится с помощью виджета ListView.<br>
Можно делать фильтрацию задач по месяцам срока выполнения. При этом результат выборки кэшируется на 30 секунд</h4>";

echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => function($model){
        return \app\widgets\CardPreview::widget([
            'model' => $model
        ]);
    },
    'summary' => false,
    'options' => [
        'class' => 'preview-container', //переопределяет класс в который будет обернут весь список
    ],
    'itemOptions' => [
        'class' => 'preview', //переопределяет класс в который будет обернут каждый элемент списка
    ],

]);

//Создадим форму для фильтрации задач по месяцам
echo "<div class=\"select-month\">";
echo \yii\helpers\Html::beginForm([''], 'get');
echo \yii\helpers\Html::label(\Yii::t("app", "filter_by_months"));
echo "&nbsp; &nbsp; &nbsp;";
echo \yii\helpers\Html::dropDownList('month', null, $monthArray, ['prompt' => \Yii::t("app", "select_month")]);
echo \yii\helpers\Html::submitButton(\Yii::t("app", "apply"));
echo \yii\helpers\Html::endForm();
echo "</div>";