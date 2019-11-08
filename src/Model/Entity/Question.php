<?php
// src/Model/Entity/Question.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Question extends Entity
{
    //一括代入 (MassAssignment) によって どのようにプロパティーを変更できるかを制御するプロパティー
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'slug' => false,
    ];
}
