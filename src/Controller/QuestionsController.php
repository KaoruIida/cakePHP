<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * 問題/答え一覧、登録、編集、削除ページ
 * Class QuestionsController
 * @package App\Controller
 */
class QuestionsController extends AppController
{
    /**
     * 問題/答え一覧画面
     * questionList method
     */
    public function questionList()
    {
        $questions = $this->Questions->find('all')->contain(['CorrectAnswers']);
        // 登録数が0の場合は一覧でなく登録画面に遷移する
        if ($questions->isEmpty()) {
            return $this->redirect(['action' => 'register']);
        }
        $this->set('questions', $questions);
    }

    /**
     * バリデーションチェック（登録＆編集）
     */
    private function checkErrors()
    {
        $errors = [];
        // 問題のチェック
        $question = $this->request->getData('question');
        if (empty($question)) { // 必須チェック
            $errors['question'] = '問題は必須項目です。必ず入力してください。';
        } elseif (strlen($question) > 500) { // 文字数チェック
            $errors['question'] = '問題は500文字以内で設定してください。';
        }
        // 回答のチェック
        $answers = $this->request->getData('correct_answers');
        // 回答が空ではない場合
        if (! empty($answers)) {
            // $errors['answer']が存在するか確認
            if (! isset($errors['answer'])) {
                $errors['answer'] = [];
            }
            foreach ($answers as $key => $answer) {
                if (empty($answer['answer'])) { // 空欄チェック
                    $errors['answer'][$key] = '回答は必須項目です。必ず入力してください。';
                } elseif (strlen($answer['answer']) > 20) { // 文字数チェック
                    $errors['answer'][$key] = '回答は20文字以内で設定してください。';
                }
            }
        }
        // 回答のエラーが無ければ、$errors['answer']を削除
        if (empty($errors['answer'])) {
            unset($errors['answer']);
        }
        return $errors;
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
                return $this->redirect(['action' => 'questionList']);
            } else {
                $this->Flash->error(__('登録失敗しました'));
                // 登録失敗の画面表示
                $this->set('questions', $question);
            }
        } else {
            // セッションで入力内容をリダイレクト先のviewに渡す
            $this->setSessionViewData('errors');
            $this->setSessionViewData('register_input', 'return_data');
        }
    }

    /**
     * 問題/答え登録確認画面
     * registerConfirm method
     */
    public function registerConfirm()
    {
        // セッションが残っていたら削除する
        $this->hasSessionDelete('errors');
        $this->hasSessionDelete('register_input');

        if ($this->request->is('post')) {
            // エラーチェック
            if ($errors = $this->checkErrors()) {
                $this->session->write([
                    'errors' => $errors,
                    'register_input' => $this->request->getData()
                ]);
                return $this->redirect($this->referer());
            }
            // registerの問題/答えを渡す
            $this->set('questions', $this->request->getData());
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
            // primarykey(id)を指定してQuestionsデータを取得
            $questions = $this->Questions->get($questionsId);
            $postData = $this->request->getData();
            $questions = $this->Questions->patchEntity($questions, $postData);
            // 上で指定した処理を実行しつつ結果を代入する
            if ($this->Questions->save($questions)) {
                $this->Flash->success('編集できました');
                return $this->redirect(['action' => 'questionList']);
            } else {
                $this->Flash->error('編集失敗しました');
                // 編集失敗の画面表示
                $this->set('questions', $this->Questions->get($questionsId, ['contain' => ['CorrectAnswers']]));
            }
        } else {
            // セッションで入力内容をリダイレクト先のviewに渡す
            $this->setSessionViewData('errors');
            $this->setSessionViewData('edit_input', 'return_data');
            $questions = $this->Questions->get($id, ['contain' => ['CorrectAnswers']]);
            $this->set('questions', $questions);
        }
    }

    /**
     * 問題/答え編集確認画面
     * editConfirm method
     */
    public function editConfirm()
    {
        // セッションが残っていたら削除する
        $this->hasSessionDelete('errors');
        $this->hasSessionDelete('edit_input');

        if ($this->request->is('post')) {
            // エラーチェック
            if ($errors = $this->checkErrors()) {
                $this->session->write([
                    'errors' => $errors,
                    'edit_input' => $this->request->getData()
                ]);
                return $this->redirect($this->referer());
            }
            // editの問題/答えを渡す
            $this->set('questions', $this->request->getData());
        }
    }

    /**
     * 問題/答え削除確認画面
     * deleteConfirm method
     */
    public function deleteConfirm($questionsId = null)
    {
        if ($this->request->is(['post'])) {
            // postデータからQuestionsのidを取得して一旦変数に展開
            $deleteId = $this->request->getData('questions_id');
            // primarykey(id)を指定してQuestionsデータを取得
            $questions = $this->Questions->get($deleteId);
            if ($this->Questions->delete($questions)) {
                $this->Flash->success('削除できました');
                return $this->redirect(['action' => 'questionList']);
            } else {
                $this->Flash->error('削除失敗しました');
            }
        } else {
            // 削除する問題/答えを渡す
            $this->set('questions', $this->Questions->get($questionsId, ['contain' => ['CorrectAnswers']]));
        }
    }
}
