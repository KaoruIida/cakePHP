<!-- File: src/Template/Questions/question_list.ctp -->
<?php $this->assign('title', '問題/答え一覧画面'); ?>

<?= $this->Html->link('新規作成', ['action' => 'register']) ?>

<table>
    <tr>
        <th>問題</th>
        <th>答え</th>
    </tr>
    <?php foreach ($questions as $question): ?>
        <tr>
            <td>
                <?= $question['question'] ?>
                <?= $this->Html->link('削除', ['action' => 'deleteConfirm', $question['id']]) ?>
                <?= $this->Html->link('編集', ['action'=>'edit', $question['id']]) ?>
            </td>
            <td>
                <?php foreach ($question['correct_answers'] as $correct_answers): ?>
                    <?= $correct_answers['answer'] ?><br>
                <?php endforeach; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
