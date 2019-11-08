<!-- File: src/Template/Questions/edit_confirm.ctp -->
<?php $this->assign('title', '問題/答え編集確認画面'); ?>

<?= $this->Form->create('questions',['url' => ['controller' => 'Questions', 'action' => 'edit'], 'type' => 'post']);?>
<?= $this->Form->input('id', ['type' => 'text', 'readonly' => 'readonly', 'default' => $questions['id']]) ?>
<?= $this->Form->input('question', ['type' => 'text', 'readonly' => 'readonly', 'default' => $questions['question']]) ?>
<?php foreach ($questions['correct_answers'] as $key => $correct_answers): ?>
    <?= $this->Form->input("correct_answers.$key.id",['type' =>'hidden', 'default' => $correct_answers['id']]) ?>
    <?= $this->Form->input("correct_answers.$key.answer", array('value'  => $correct_answers['answer'], 'type' => 'text', 'readonly' => 'readonly')) ?>
<?php endforeach; ?>
<?= $this->Form->button('登録', ['value' => 'save']); ?>
<?= $this->Form->end() ?>
