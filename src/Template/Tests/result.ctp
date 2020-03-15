<?php $this->assign('title', 'テスト採点結果画面'); ?>

<?= h($results['user_name']. 'さん') ?><br />
<?= h($results['question_count']. '問中'.$results['correct_count']. '問正解です。') ?><br />
<?= h($results['point']. '点でした。') ?><br />
<?= h($results['datetime']->i18nFormat('YYYY/MM/dd HH:mm:ss')) ?>




