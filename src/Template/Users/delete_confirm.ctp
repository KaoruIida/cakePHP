<?php $this->assign('title', 'ユーザー削除確認画面'); ?>

<?=$this->Form->create('users', ['url' => ['controller' => 'Users', 'action' => 'deleteConfirm'], 'type' => 'post']); ?>
    <fieldset>
        <?= $this->Form->input('users_id', ['type' => 'text', 'readonly' => 'readonly', 'default' => $users['id']]); ?>
        <?= $this->Form->input('name', ['type' => 'text', 'readonly' => 'readonly', 'default' => $users['name']]); ?>
        <?= $this->Form->input('password', ['type' => 'password', 'readonly' => 'readonly', 'default' => $users['password']]); ?>
        <?= $this->Form->input('admin_flag', ['type' => 'hidden', 'default' => $users['admin_flag']]); ?>
        <?= '管理者権限：'.($users['admin_flag'] ? 'あり' : 'なし'); ?><br />
    </fieldset>
<?= $this->Form->button('削除', ['value' => 'delete']); ?>
<?= $this->Form->end(); ?>
