<?php
// src/Controller/TestsController.php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class TestsController extends AppController
{
    private $session;
    public function initialize()
    {
        parent::initialize();
        $this->session = $this->request->getSession();
    }

    /**
     * テスト画面
     * test method
     */
    public function test()
    {
        $questions = TableRegistry::getTableLocator()->get('questions');
        $query = $questions->find('all', ['order' => 'rand()']);
        $this->set('questions', $query->toArray());
        //rand関数で生成した文字列＋マイクロ秒単位にもとづいた文字列＋エントロピー文字列
        //さらにmd5ハッシュ変換を行う
        $token = md5(uniqid(rand(), true));
        // セッションデータの書き込み
        $this->session->write(['token' => $token]);
        // セッションデータの読み込み
        $this->set('token', $token);
    }

    /**
     * 採点画面
     * result method
     */
    public function result()
    {
        if ($this->request->is('post')) {
            if (! $this->session->read('token') || $this->session->read('token') !== $this->request->getData('token')) {
                return $this->redirect(['controller' => 'Tests', 'action' => 'history']);
            }
            $user = $this->Auth->user();
            if ($user === null) {
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }
            //ユーザーの回答
            $request_answers = $this->request->getData('answer');
            //ユーザーの回答とCorrect_answersテーブルのanswerが一致しているか正誤判定
            $correct_answers = TableRegistry::getTableLocator()->get('correct_answers');
            //正解数
            $correct_count = 0;
            foreach ($request_answers as $request_answer) {
                $query = $correct_answers->find()->where(['questions_id' => $request_answer['question_id']]);
                foreach ($query as $correct_answer) {
                    // 回答が一致したら加算
                    if ($request_answer['users_answer'] == $correct_answer['answer']) {
                        $correct_count++;
                        break;
                    }
                }
            }
            //全問題数
            $question_count = count($request_answers);
            // ユーザーの点数(100点満点中)
            $point = round(100 * $correct_count / $question_count);
            // 採点時間＝現在日時を設定
            $datetime = new Time();
            //採点結果画面に渡す配列
            $results = [
                'user_name' => $user['name'],
                'correct_count' => $correct_count,
                'question_count' => $question_count,
                'point' => $point,
                'datetime' => $datetime
            ];
            $this->saveHistories($user['id'], $point, $datetime);
            $this->set('results', $results);
            $this->session->delete('token');
        }
    }

    private function saveHistories($user_id, $point, $datetime)
    {
        // Histories テーブルに登録
        $histories = TableRegistry::getTableLocator()->get('histories');
        $historiesEntity = $histories->newEntity();
        // 登録データの作成
        $historiesEntity->user_id = $user_id;
        $historiesEntity->point = $point;
        $historiesEntity->created_at = $datetime;
        $histories->save($historiesEntity);
    }

    /**
     * 履歴画面
     * history method
     */
    public function history()
    {
        $user = $this->Auth->user();
        if ($user === null) {
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
        $histories = TableRegistry::getTableLocator()->get('histories');
        $this->set('user_name', $user['name']);
        $query = $histories->find('all')->where(['user_id' => $user['id']]);
        $this->set('histories', $query->toArray());
    }
}
