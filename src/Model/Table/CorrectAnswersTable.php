<?php
// src/Model/Table/CorrectAnswersTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class CorrectAnswersTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');//createdなどが自動更新されるビヘイビアー
        $this->setTable('correct_answers');
    }
}
