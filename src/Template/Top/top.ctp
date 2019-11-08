<!-- File: src/Template/Top/index.ctp -->
<?php $this->assign('title', 'Top画面'); ?>

<?= $this->Html->link('問題と答えを確認・登録する ＞',  array('controller' => 'Questions', 'action' => 'questionList')) ?>
<br />
<?= $this->Html->link('テストをする ＞', array('controller' => 'Tests', 'action' => 'test')) ?>
<br />
<?= $this->Html->link('過去の採点結果をみる ＞', array('controller' => 'Tests', 'action' => 'history')) ?>
