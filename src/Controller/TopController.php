<?php
namespace App\Controller;

use Cake\Event\Event;

/**
 * トップページ
 * Class TopController
 * @package App\Controller
 */
class TopController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }

    /**
     * トップ画面
     * top method
     */
    public function top()
    {
        // ログインユーザー情報をセット
        $loginUser = $this->Auth->user();
        $this->set('admin_flag', $loginUser['admin_flag']);
        // setで渡したデータを使ってViewを描画する
        $this->render('top', 'top_layout');
    }
}
