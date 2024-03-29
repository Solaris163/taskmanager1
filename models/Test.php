<?php
namespace app\models;
use yii\base\Model;

class Test extends Model
{
    public $content;
    public $title;
    public $count;

    public function rules()
    {
        return[
            [['title', 'content'],  'required'],
            [['count'], 'safe']
        ];
    }

    public function myValidate($attr, $params)
    {
        var_dump($attr);
        if(!in_array($this->$attr,[3 , 4, 5])){
            $this->addError($attr,  "Неверный диапазон");
        }
    }


}