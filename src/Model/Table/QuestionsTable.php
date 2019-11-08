<?php
// src/Model/Table/QuestionsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class QuestionsTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');//createdなどが自動更新されるビヘイビアー

        //ひとつのquestions_idと紐づけて複数のanswerを出力する設定
        $this->hasMany('CorrectAnswers')
        ->setForeignKey('questions_id')//リレーションする「先」のテーブルの、紐づけるカラム
        ->setDependent(true);
    }
}
