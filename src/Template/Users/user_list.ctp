<?php $this->assign('title', 'ユーザー一覧画面'); ?>

<?= $this->Html->link('新規作成', ['action' => 'register']) ?>

<table>
    <tr>
        <th>ID</th>
        <th>権限</th>
        <th>ユーザー名</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td>
                <?= $user['id'] ?>
            </td>
            <td>
                <?= $user['admin_flag'] ? '管理者' : '一般' ?>
            </td>
            <td>
                <?= $user['name'] ?>
                <?= $this->Html->link('編集', ['controller' => 'Users', 'action'=>'edit', $user['id']]) ?>
                <?php if($login_user['id'] !== $user['id']): ?>
                <?= $this->Html->link('削除', ['controller' => 'Users', 'action' => 'deleteConfirm', $user['id']]) ?>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
