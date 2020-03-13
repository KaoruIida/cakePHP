<?php $this->assign('title', 'テスト画面'); ?>

<?=$this->Form->create('users_answer', ['url' => ['controller' => 'Tests', 'action' => 'result'], 'type' => 'post']);?>
<?= $this->Form->input('token', ['type' =>'hidden', 'default' => $token]); ?>
<fieldset>
    <?php foreach ($questions as $key => $question): ?>
        <?= $this->Form->label('question', $question['question']); ?>
        <?= $this->Form->input("answer.$key.question_id", ['type' =>'hidden', 'default' => $question['id']]); ?>
        <?= $this->Form->input("answer.$key.users_answer", ['type' => 'text']); ?>
    <?php endforeach; ?>
</fieldset>
<?= $this->Form->button(__('採点')) ?>
<?= $this->Form->end() ?>
