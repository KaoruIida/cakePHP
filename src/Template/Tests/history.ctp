<?php $this->assign('title', '採点結果履歴画面'); ?>

  <table>
    <tr>
        <th>氏名</th>
        <th>得点</th>
        <th>採点時間</th>
    </tr>
      <?php foreach ($histories as $history): ?>
      <tr>
          <td>
              <?= h($user_name) ?>
          </td>
          <td>
              <?= $history['point']. '点' ?>
          </td>
          <td>
              <?= $history['created_at']->i18nFormat('YYYY/MM/dd HH:mm:ss') ?>
          </td>
      </tr>
      <?php endforeach; ?>
  </table>
