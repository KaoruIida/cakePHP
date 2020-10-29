<?php $this->assign('title', 'ユーザー新規登録確認画面'); ?>

<?= $this->Form->create('users', ['url' => ['controller' => 'Users', 'action' => 'register'], 'type' => 'post']);?>
<?= $this->Form->input('name', ['type' => 'text', 'readonly' => 'readonly']) ?>
<?= $this->Form->input('password', ['type' => 'text', 'readonly' => 'readonly']) ?>
<?= $this->Form->input('admin_flag', ['type' => 'hidden']) ?>
<?= '管理者権限：'. ($user['admin_flag'] ? 'あり' : 'なし') ?><br />
<?= $this->Form->button('登録', ['value' => 'save']); ?>
<?= $this->Form->end() ?>
