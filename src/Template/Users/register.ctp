<?php $this->assign('title', 'ユーザー新規登録画面'); ?>

<?=$this->Form->create($user, ['url' => ['controller' => 'Users', 'action' => 'registerConfirm'], 'type' => 'post', 'id' => 'userForm']); ?>
    <fieldset>
        <legend><?= __('ユーザー登録') ?></legend>
        <?= $this->Form->control('name', ['id' => 'name']) ?>
        <?= $this->Form->control('password', ['id' => 'password', 'type' => 'password']) ?>
        <?= $this->Form->control('admin_flag', ['type' => 'checkbox']) ?>
    </fieldset>
<?= $this->Form->button(__('確認'), ['type' => 'button', 'id' => 'userButton']) ?>
<?= $this->Form->end() ?>
<?= $this->Html->script('checkUser'); ?>
