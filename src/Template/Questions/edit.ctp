<?php $this->assign('title', '問題/答え編集画面'); ?>

<?=$this->Form->create('questions', ['url' => ['controller' => 'Questions', 'action' => 'editConfirm'], 'type' => 'post']); ?>
    <fieldset>
        <!--バリデーションエラーでリダイレクトした場合-->
        <?php if (isset($return_data) && isset($errors)): ?>
            <!--問題-->
            <!--入力されていたデータをvalueに-->
            <?= $this->Form->input('id', ['type' => 'text', 'readonly' => 'readonly', 'default' => $return_data['id']]) ?>
            <?= $this->Form->input('question', ['value' => $return_data['question']]) ?>
            <!--エラーメッセージorエラーでない場合は非表示-->
            <?= $errors['question'] ?? '' ?>
            <!--回答-->
            <?php foreach ($return_data['correct_answers'] as $key => $answer): ?>
                <!--入力されていたデータをvalueに-->
                <div class="addAnswer">
                    <?= $this->Form->input("correct_answers.$key.id", ['type' => 'hidden', 'value' => $answer['id']]);  ?>
                    <?= $this->Form->input("correct_answers.$key.answer", ['value' => $answer['answer']]) ?>
                    <!--エラーメッセージorエラーでない場合は非表示-->
                    <p class="error-message">
                        <?= $errors['answer'][$key] ?? '' ?>
                    </p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!--通常の場合-->
            <?= $this->Form->input('id', ['type' => 'text', 'readonly' => 'readonly', 'default' => $questions['id']]); ?>
            <?= $this->Form->input('question', ['value' => $questions['question']]); ?>
            <?php foreach ($questions['correct_answers'] as $key => $correct_answers): ?>
                <div class="addAnswer">
                    <?= $this->Form->input("correct_answers.$key.id", ['type' => 'hidden', 'value' => $correct_answers['id']]); ?>
                    <?= $this->Form->input("correct_answers.$key.answer", ['value' => $correct_answers['answer']]); ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </fieldset>
<?= $this->Form->button(__('追加'), ['id' => 'addButton','type' => 'button']); ?>
<?= $this->Form->button(__('確認')); ?>
<?= $this->Form->end(); ?>
<!--</body>タグ直前に配置-->
<?= $this->Html->script('addAnswer') ?>
