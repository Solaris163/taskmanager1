<?php

namespace app\components;

// Класс добавлен в массив 'bootstrap' для запуска в начале приложения
// Класс отслеживает добавление задачи в базу данных и отсылает сообщение ответственному
use app\models\tables\Tasks;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\Event;

class SendMessage extends Component implements BootstrapInterface
{
    public function bootstrap($app)//метод будет вызван при запуске приложения
    {
        Event::on(
            Tasks::class, //класс к объектам которого подключается событие
            Tasks::EVENT_AFTER_INSERT, //событие добавления задачи в базу данных
            [$this, 'handler']
        );
    }

    //метод получет из переменной $event электронный адрес и вызывает метод contact
    public function handler($event)
    {
        $task = $event->sender; //получаем из эвента модель, инициировшую сохранение в базу
        $responsible = $task->responsible; //получаем объект получателя письма
        $email = $responsible->email; //получаем адрес получателя
        $taskId = $task->id; //получаем id, сохраненной в базу задачи
        $this->contact($email, $taskId); //вызываем метод contact
    }

    public function contact($email, $taskId)
    {
        \Yii::$app->mailer->compose()
            ->setTo($email)
            ->setSubject('нет темы')
            ->setTextBody("вам добавлена задача с id={$taskId}" )
            ->send();
    }
}