<!-- File: src/Template/Questions/Confirm.ctp -->
<?php $this->assign('title', '問題/答え登録確認画面'); ?>

<?= $this->Form->create('questions',['url' => ['controller' => 'Questions', 'action' => 'register'], 'type' => 'post']);?>
<?= $this->Form->input('question', ['type' => 'text', 'readonly' => 'readonly']) ?>
<?php for ($i=0; $i<3; $i++): ?>
    <?= $this->Form->input("correct_answers.$i.answer", ['type' => 'text', 'readonly' => 'readonly']) ?>
<?php endfor; ?>
<?= $this->Form->button('登録', ['value' => 'save']); ?>
<?= $this->Form->end() ?>
