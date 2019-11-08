<!-- File: src/Template/Questions/register.ctp -->
<?php $this->assign('title', '問題/答え登録画面'); ?>

<?=$this->Form->create('questions', ['url' => ['controller' => 'Questions', 'action' => 'registerConfirm'], 'type' => 'post']);?>
<fieldset>
    <?= $this->Form->input('question') ?>
    <?php for ($i=0; $i<3; $i++): ?>
        <?= $this->Form->input("correct_answers.$i.answer") ?>
    <?php endfor; ?>
</fieldset>
<?= $this->Form->button(__('確認')) ?>
<?= $this->Form->end() ?>
