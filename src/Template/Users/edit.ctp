<?php $this->assign('title', 'ユーザー登録編集画面'); ?>

<?=$this->Form->create($users, ['url' => ['controller' => 'Users', 'action' => 'editConfirm'], 'type' => 'post', 'id' => 'passForm']); ?>
<fieldset>
    <!--バリデーションエラーでリダイレクトした場合-->
    <?php if (isset($return_data) && isset($errors)): ?>
        <!--パスワードのみ-->
        <!--入力されていたデータをvalueに-->
        <?= $this->Form->input('id', ['type' => 'text', 'readonly' => 'readonly', 'default' => $return_data['id']]) ?>
        <?= $this->Form->input('name', ['type' => 'text', 'readonly' => 'readonly', 'default' => $return_data['name']]) ?>
        <?= $this->Form->input('password', ['type' => 'password', 'value' => $return_data['password']]) ?>
        <!--エラーメッセージorエラーでない場合は非表示-->
        <?= $errors['password'] ?? '' ?>
        <?= $this->Form->input('password_confirm', ['type' => 'password', 'value' => $return_data['password_confirm']]) ?>
        <?= $this->Form->control('admin_flag', ['type' => 'checkbox', 'default' => $return_data['admin_flag']]); ?>
    <?php else: ?>
        <!--通常の場合-->
        <?= $this->Form->input('id', ['type' => 'text', 'readonly' => 'readonly', 'default' => $users['id']]); ?>
        <?= $this->Form->input('name', ['type' => 'text', 'readonly' => 'readonly', 'default' => $users['name']]); ?>
        <?= $this->Form->input('password', ['type' => 'password', 'value' => $users['password']]); ?>
        <?= $this->Form->input('password_confirm', ['type' => 'password', 'id' => 'password_confirm']); ?>
        <?= $this->Form->control('admin_flag', ['type' => 'checkbox', 'default' => $users['admin_flag']]); ?>
    <?php endif; ?>
</fieldset>
<?= $this->Form->button(__('確認'), ['id' => 'passButton','type' => 'button']); ?>
<?= $this->Form->end(); ?>
<!--</body>タグ直前に配置-->
<?= $this->Html->script('checkPass') ?>

