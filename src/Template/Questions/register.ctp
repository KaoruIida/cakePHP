<?php $this->assign('title', '問題/答え登録画面'); ?>

<!--問題/答えを登録するForm-->
<?=$this->Form->create($questions ?? 'questions', ['url' => ['controller' => 'Questions', 'action' => 'registerConfirm'], 'type' => 'post']); ?>
    <fieldset>
        <!--バリデーションエラーでリダイレクトした場合-->
        <?php if (isset($return_data) && isset($errors)): ?>
            <!--入力されていたデータをvalueに-->
            <?= $this->Form->input('question', ['value' => $return_data['question']]) ?>
            <!--エラーメッセージorエラーでない場合は非表示-->
            <?= $errors['question'] ?? '' ?>
            <?php foreach ($return_data['correct_answers'] as $key => $answer): ?>
                <!--入力されていたデータをvalueに-->
                <div class="addAnswer">
                    <?= $this->Form->input("correct_answers.$key.answer", ['value' => $answer['answer']]) ?>
                    <!--エラーメッセージorエラーでない場合は非表示-->
                    <p class="error-message">
                        <?= $errors['answer'][$key] ?? '' ?>
                    </p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!--通常の場合-->
            <?= $this->Form->input('question') ?>
            <!--エンティティがある場合はデータが渡ってくるので、動的に増やした回答もループして表示-->
            <?php if (isset($questions)): ?>
                <?php foreach ($questions->correct_answers as $key => $answer): ?>
                    <?= $this->Form->input("correct_answers.$key.answer") ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="addAnswer">
                    <?= $this->Form->input("correct_answers.0.answer"); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </fieldset>
<?= $this->Form->button(__('追加'), ['type' => 'button', 'id' => 'addButton']); ?>
<?= $this->Form->button(__('確認')); ?>
<?= $this->Form->end(); ?>
<!--</body>タグ直前に配置-->
<?= $this->Html->script('addAnswer') ?>
