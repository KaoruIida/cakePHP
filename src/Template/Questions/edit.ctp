<!-- File: src/Template/Questions/edit.ctp -->
<?php $this->assign('title', '問題/答え編集画面'); ?>

<?=$this->Form->create('questions', ['url' => ['controller' => 'Questions', 'action' => 'editConfirm'], 'type' => 'post']);?>
<fieldset>
    <?= $this->Form->input('id', ['type' => 'text', 'readonly' => 'readonly', 'default' => $questions['id']]) ?>
    <?= $this->Form->input('question', ['default' => $questions['question']]) ?>
    <?php foreach ($questions['correct_answers'] as $key => $correct_answer): ?>
        <?= $this->Form->input("correct_answers.$key.id", ['type' => 'hidden', 'default' => $correct_answer['id']]) ?>
        <?= $this->Form->input("correct_answers.$key.answer", ['default' => $correct_answer['answer']]) ?>
    <?php endforeach; ?>
</fieldset>
<?= $this->Form->button(__('確認')) ?>
<?= $this->Form->end() ?>
