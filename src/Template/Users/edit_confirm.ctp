<?php $this->assign('title', 'ユーザー編集確認画面'); ?>

<?= $this->Form->create('users', ['url' => ['controller' => 'Users', 'action' => 'edit'], 'type' => 'post']);?>
<?= $this->Form->input('id', ['type' => 'text', 'readonly' => 'readonly', 'default' => $users['id']]) ?>
<?= $this->Form->input('name', ['type' => 'text', 'readonly' => 'readonly', 'default' => $users['name']]) ?>
<?= $this->Form->input('password', ['type' => 'text', 'readonly' => 'readonly']) ?>
<?= $this->Form->input('password_confirm', ['type' => 'text', 'readonly' => 'readonly']) ?>
<?= $this->Form->input('admin_flag', ['type' => 'hidden']) ?>
<?= '管理者権限：'. ($users['admin_flag'] ? 'あり' : 'なし') ?><br />
<?= $this->Form->button('登録', ['value' => 'save']); ?>
<?= $this->Form->end() ?>
