<!-- File: src/Template/Questions/delete_confirm.ctp -->
<?php $this->assign('title', '問題/答え削除画面'); ?>

<?=$this->Form->create('questions', ['url' => ['controller' => 'Questions', 'action' => 'deleteConfirm'], 'type' => 'post']);?>
<fieldset>
    <?= $this->Form->input('id', ['type' => 'text', 'readonly' => 'readonly', 'default' => $questions['id']]) ?>
    <?= $this->Form->input('question', ['type' => 'text', 'readonly' => 'readonly', 'default' => $questions['question']]) ?>
    <?php foreach ($questions['correct_answers'] as $key => $correct_answers): ?>
        <?= $this->Form->input("correct_answers.$key.answer", ['type' => 'text', 'readonly' => 'readonly', 'default' => $correct_answers['answer']]) ?>
    <?php endforeach; ?>
</fieldset>
<?= $this->Form->button('削除', ['value' => 'delete']); ?>
<?= $this->Form->end() ?>
