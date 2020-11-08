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
        // 半角英数字の独自ルール
        $validator->provider('Custom', 'App\Model\Validation\CustomValidation');

        $validator
            // ユーザー名
            ->requirePresence('name', 'create')// NOT NUL(必須項目)
            ->notEmpty('name', '名前は入力必須項目です')// 空欄チェック
            // 半角英数字チェック
            ->add('name', 'alphaNumericRule', [
                'rule' => ['alphaNumeric'],
                'provider' => 'Custom',
                'message' => '名前は半角英数字で入力してください',
            ])
            // パスワード
            ->requirePresence('password', 'create')// NOT NUL(必須項目)
            ->notEmpty('password', 'パスワードは入力必須項目です', 'create')// 空欄チェック
            // 半角英数字8文字以上
            ->minLength('password', 8, 'パスワードは8字以上で入力してください')
            // 半角英数字チェック
            ->add('password', 'alphaNumericRule', [
                'rule' => ['alphaNumeric'],
                'provider' => 'Custom',
                'message' => 'パスワードは半角英数字で入力してください',
            ])

            // 管理者or一般チェック
            ->add('admin', 'boolean', [
                'rule' => 'boolean'
            ]);
        return $validator;
    }
}
