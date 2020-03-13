<?php $this->assign('title', 'Top画面'); ?>

<?= $this->Html->link('問題と答えを確認・登録する ＞', ['controller' => 'Questions', 'action' => 'questionList']) ?>
<br />
<?= $this->Html->link('テストをする ＞', ['controller' => 'Tests', 'action' => 'test']) ?>
<br />
<?= $this->Html->link('過去の採点結果をみる ＞', ['controller' => 'Tests', 'action' => 'history']) ?>
