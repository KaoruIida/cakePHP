<?php $this->assign('title', 'ログイン画面'); ?>

<div class="users form">
    <?= $this->Flash->render() ?>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('名前とパスワードを入れてください') ?></legend>
        <?= $this->Form->control('name') ?>
        <?= $this->Form->control('password') ?>
    </fieldset>
    <?= $this->Form->button(__('ログイン')) ?>
    <?= $this->Form->end() ?>
</div>
