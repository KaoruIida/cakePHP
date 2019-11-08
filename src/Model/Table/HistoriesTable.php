<?php
// src/Model/Table/QuestionsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class HistoriesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');//createdなどが自動更新されるビヘイビアー

    }
}
