<?php
namespace App\Controller;

use Cake\Event\Event;

/**
 * ユーザー一覧、登録、編集、削除ページ、ログイン/ログアウト
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
     * ユーザー一覧
     * userList method
     */
    public function userList()
    {
        $users = $this->Users->find('all');
        // 登録数が0の場合は一覧でなく登録画面に遷移する
        if ($users->isEmpty()) {
            return $this->redirect(['action' => 'register']);
        }
        $this->set('users', $users);
        // ログインユーザー情報をセット
        $loginUser = $this->Auth->user();
        $this->set('login_user', $loginUser);
    }

    /**
     * バリデーションチェック（登録＆編集）
     */
    private function checkErrors()
    {
        $errors = [];
        // パスワード
        $password = $this->request->getData('password');
        // パスワード確認用
        $passwordConfirm = $this->request->getData('password_confirm');
        // パスワードが空ではない場合、パスワードと確認用の一致チェック
        if (! empty($password) && $password !== $passwordConfirm) {
            $errors['password'] = '確認用のパスワードと一致しません';
        }
        // 回答のエラーが無ければ、$errors['answer']を削除
        if (empty($errors['answer'])) {
            unset($errors['answer']);
        }
        return $errors;
    }

    /**
     * ユーザー新規登録
     * register method
     */
    public function register()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, array_merge($this->request->getData(), ['delete_flag' => 0]));
            if ($this->Users->save($user)) {
                $this->Flash->success(__('ユーザーが登録されました。'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('ユーザーが登録されません。やり直してください。'));
        }
        $this->set(compact('user'));
    }

    /**
     * ユーザー新規登録確認画面
     * registerConfirm method
     */
    public function registerConfirm()
    {
        if ($this->request->is('post')) {
            // registerの内容を渡す
            $this->set('user', $this->request->getData());
        }
    }

    /**
     * ユーザー編集画面
     * edit method
     */
    public function edit($id = null)
    {
        // nameのバリデーション無効化
        $this->Users->validator('default')->offsetUnset('name');

        if ($this->request->is(['post'])) {
            // postデータからUsersのidを取得して一旦変数に展開
            $usersId = $this->request->getData('id');
            // primarykey(id)を指定してUsersデータを取得
            $users = $this->Users->get($usersId);
            $postData = $this->request->getData();
            // passwordが空欄の場合、パスワード変更はなし
            if (empty($postData['password'])) {
                unset($postData['password'], $postData['password_confirm']);
            }
            $users = $this->Users->patchEntity($users, $postData);
            // 上で指定した処理を実行しつつ結果を代入する
            if ($users->getErrors()) {
                $this->set('users', $users);
            } else {
                $this->Users->save($users);
                $this->Flash->success('ユーザーが編集できました。');
                return $this->redirect(['action' => 'userList']);
            }
        } else {
            // editConfirm()からのリダイレクトをセッションデータで確認
            $this->isSessionViewData('errors');
            $this->isSessionViewData('edit_input', 'return_data');
            if ($this->session->check('users')) {
                $users = $this->session->read('users');
                $this->set('users', $users);
            } else{
                // セッションに存在しない場合はDBデータを表示
                $users = $this->Users->get($id);
                $this->set('users', $users);
            }
        }
    }


    /**
     * ユーザー編集確認画面
     * editConfirm method
     */
    public function editConfirm()
    {
        // セッションが残っていたら削除する
        $this->hasSessionDelete('errors');
        $this->hasSessionDelete('edit_input');
        $this->hasSessionDelete('users');

        if ($this->request->is('post')) {
            $usersId = $this->request->getData('id');
            $users = $this->Users->get($usersId);
            $postData = $this->request->getData();
            $users = $this->Users->patchEntity($users, $postData);
            // 文字数&半角英数字のエラーチェック
            if ($users->getErrors()) {
                $this->session->write([
                    'edit_input' => $this->request->getData(),
                    'users' => $users
                ]);
                return $this->redirect($this->referer());
            }
            // 内容一致のエラーチェック
            if ($errors = $this->checkErrors()) {
                $this->session->write([
                    'edit_input' => $this->request->getData(),
                    'errors' => $errors
                ]);
                return $this->redirect($this->referer());
            }
            // editの問題/答えを渡す
            $this->set('users', $this->request->getData());
        }
    }

    /**
     * ユーザー削除確認画面
     * deleteConfirm method
     */
    public function deleteConfirm($usersId = null)
    {
        if ($this->request->is(['post'])) {
            // postデータからUsersのidを取得して一旦変数に展開
            $deleteId = $this->request->getData('users_id');
            // primarykey(id)を指定してUsersデータを取得
            $users = $this->Users->get($deleteId);
            if ($this->Users->delete($users)) {
                $this->Flash->success('削除できました');
                return $this->redirect(['action' => 'userList']);
            } else {
                $this->Flash->error('削除失敗しました');
            }
        } else {
            // 削除するユーザー情報を渡す
            $this->set('users', $this->Users->get($usersId));
        }
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
