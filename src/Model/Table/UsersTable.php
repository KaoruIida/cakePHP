<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');

        $this->hasMany('Histories')
            ->setForeignKey('user_id')
            ->setDependent(true);
    }
    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('name', '名前の入力は必須です')
            ->notEmpty('password', 'パスワードの入力は必須です');
    }
}
