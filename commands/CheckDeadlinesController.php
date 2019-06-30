<?php


namespace app\commands;


use app\models\tables\Tasks;
use yii\console\Controller;

//метод actionCheck класса вызывается консольной командой, находит задачи, у которых истекает срок выполнения
//и отправляет сообщения ответственным
class CheckDeadlinesController extends Controller
{
    public function actionCheck()
    {
        $tasks = Tasks::getExpiresTasks();//массив с задачами, у которых истекает срок, и адресами исполнителей
        //Этот массив получается одним SQL-запросом, чтобы не делать отдельные запросы для поиска email исполнителей

        //Как делал учитель - получил из базы таблицу tasks и связь к ней responsible, которая указана в модели Tasks
        //с помощью метода with()
        //только тогда будет объект, а не массив, обращаться нужно так: $task->responsible->email а не $task["email"]
//        $tasks = Tasks::find()->where("DATEDIFF(NOW(), tasks.deadline) <= 1")->with('responsible')->all();

        foreach($tasks as $task) //перебираем массив и отправляем сообщения пользователям вызвав метод contact
		{
		    echo $task["id"];
            $this->contact($task["email"], $task["id"]);
        }
	}

    public function contact($email, $taskId)
    {
        echo $taskId;
        \Yii::$app->mailer->compose() //компонент 'mailer' нужно добавить в папке config из web.php в console.php
            ->setTo($email)
            ->setSubject('Deadline Expires')
            ->setTextBody("Deadline of task with id={$taskId} expires soon")
            ->send();
    }
}