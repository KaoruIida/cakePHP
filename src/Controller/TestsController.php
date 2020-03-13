<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * テスト、採点、履歴ページ
 * Class QuestionsController
 * @package App\Controller
 */
class TestsController extends AppController{

    /**
     * テスト画面
     * test method
     */
    public function test()
    {
        $questions = TableRegistry::getTableLocator()->get('questions');
        $query = $questions->find('all', ['order' => 'rand()']);
        $this->set('questions', $query->toArray());
        // rand関数で生成した文字列＋マイクロ秒単位にもとづいた文字列＋エントロピー文字列
        // md5ハッシュ変換
        $token = md5(uniqid(rand(), true));
        // セッションの書き込み
        $this->session->write(['token' => $token]);
        // セッションの読み込み
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
            // ユーザーの回答
            $requestAnswers = $this->request->getData('answer');
            // ユーザーの回答とcorrect_answersテーブルのanswerが一致しているか正誤判定
            $correctAnswers = TableRegistry::getTableLocator()->get('correct_answers');
            // 正解数
            $correctCount = 0;
            foreach ($requestAnswers as $requestAnswer) {
                $query = $correctAnswers->find()->where(['questions_id' => $requestAnswer['question_id']]);
                foreach ($query as $correctAnswer) {
                    // 回答が一致したら加算
                    if ($requestAnswer['users_answer'] == $correctAnswer['answer']) {
                        $correctCount++;
                        break;
                    }
                }
            }
            // 全問題数
            $questionCount = count($requestAnswers);
            // ユーザーの点数(100点満点中)
            $point = round(100 * $correctCount / $questionCount);
            // 採点時間＝現在日時を設定
            $datetime = new Time();
            // 採点結果画面に渡す配列
            $results = [
                'user_name' => $user['name'],
                'correct_count' => $correctCount,
                'question_count' => $questionCount,
                'point' => $point,
                'datetime' => $datetime
            ];
            $this->saveHistories($user['id'], $point, $datetime);
            $this->set('results', $results);
            $this->session->delete('token');
        }
    }

    /**
     * 採点結果を保存
     */
    private function saveHistories($userId, $point, $datetime)
    {
        // Histories テーブルに登録
        $histories = TableRegistry::getTableLocator()->get('histories');
        $historiesEntity = $histories->newEntity();
        // 登録データの作成
        $historiesEntity->user_id = $userId;
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
