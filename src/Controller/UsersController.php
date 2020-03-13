<?php
namespace App\Controller;

use Cake\Event\Event;

/**
 * ユーザー登録、ログイン、ログアウトページ
 * Class QuestionsController
 * @package App\Controller
 */
class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow();
    }
    /**
     * ユーザー登録
     * Add method
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, array_merge($this->request->getData(), ['delete_flag' => 0]));
            if ($this->Users->save($user)) {
                $this->Flash->success(__('ユーザーが登録されました'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('ユーザーが登録されません。やり直してください。'));
        }
        $this->set(compact('user'));
        $this->render('add', 'login_layout');
    }

    /**
     * ログイン
     * login method
     */
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('ユーザーが存在しません。やり直してください。'));
        }
        $this->render('login', 'login_layout');
    }

    /**
     * ログアウト
     * logout method
     */
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}
