<?php
namespace App\Model\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;
class User extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
    protected $_hidden = [
        'password'
    ];
    /**
     * パスワードのハッシュ化をおこなう
     *
     * @param $password
     * @return bool|string
     */
    protected function _setPassword($password)//パスワードのセットを行うときに呼び出されるメソッド
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
}
