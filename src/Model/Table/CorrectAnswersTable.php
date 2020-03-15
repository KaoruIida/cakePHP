<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class CorrectAnswersTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        $this->setTable('correct_answers');
        $this->setDisplayField('answer');
        $this->setPrimaryKey('id');
    }
}
