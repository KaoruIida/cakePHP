<?php
// src/Controller/QuestionsController.php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;

class QuestionsController extends AppController
{
    /**
     * 問題/答え一覧画面
     * questionList method
     */
    public function questionList()
    {
        $query = $this->Questions->find('all')->contain(['CorrectAnswers']);
        $this->set('questions', $query->toArray());
    }

    /**
     * 問題/答え登録画面
     * register method
     */
    public function register()
    {
        if ($this->request->is('post')) {
            $question = $this->Questions->newEntity();
            $question = $this->Questions->patchEntity($question, $this->request->getData());
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('登録できました'));
            } else {
                $this->Flash->error(__('登録失敗しました'));
            }
            return $this->redirect(['action' => 'questionList']);
        }
    }

    /**
     * 問題/答え登録確認画面
     * registerConfirm method
     */
    public function registerConfirm()
    {
        if ($this->request->is('post')) {
            $this->set('questions', $this->request->getData());
            $this->render("registerConfirm");
        }
    }

    /**
     * 問題/答え編集画面
     * edit method
     */
    public function edit($id = null)
    {
        if ($this->request->is(['post'])) {
            // postデータからQuestionsのidを取得して一旦変数に展開
            $questionsId = $this->request->getData('id');
            // primarykey(id)を指定してQuestionsのデータを取得
            $questions = $this->Questions->get($questionsId);
            $postData = $this->request->getData();
            $questions = $this->Questions->patchEntity($questions, $postData);
            // 更新前にcorrect_answersのデータを削除 TODO : cakePHPライクなやり方があるはず。
//            $correctAnswersTable = TableRegistry::getTableLocator()->get('CorrectAnswers');
//            $correctAnswersTable->deleteAll(['questions_id' => $questionId]);
            if ($this->Questions->save($questions)) { // データ更新
                $this->Flash->success('編集できました');
                $this->redirect(['action' => 'questionList']);
            } else {
                $this->Flash->error('編集失敗しました');
            }
        } else {
            $this->set('questions', $this->Questions->get($id, ['contain' => ['CorrectAnswers']]));
        }
    }

    /**
     * 問題/答え編集確認画面
     * editConfirm method
     */
    public function editConfirm()
    {
        if ($this->request->is('post')) {
            $this->set('questions', $this->request->getData());
        }
    }

    /**
     * 問題/答え削除確認画面
     * deleteConfirm method
     */
    public function deleteConfirm($id = null)
    {
        if ($this->request->is(['post'])) {
            // postデータからQuestionsのidを取得して一旦変数に展開
            $questionsId = $this->request->getData('id');
            // primarykey(id)を指定してQuestionsのデータを取得
            $questions = $this->Questions->get($questionsId);
            // QuestionsTable.phpのhasMany設定に基づいて、Questions並び関連データの削除
            if ($this->Questions->delete($questions)) {
                $this->Flash->success('削除できました');
                $this->redirect(['action' => 'questionList']);
            } else {
                $this->Flash->error('削除失敗しました');
            }
        } else {
            $this->set('questions', $this->Questions->get($id, ['contain' => ['CorrectAnswers']]));
        }
    }
}
