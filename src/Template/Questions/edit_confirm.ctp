<?php $this->assign('title', '問題/答え編集確認画面'); ?>

<?= $this->Form->create('questions', ['url' => ['controller' => 'Questions', 'action' => 'edit'], 'type' => 'post']);?>
<?= $this->Form->input('id', ['type' => 'text', 'readonly' => 'readonly', 'default' => $questions['id']]) ?>
<?= $this->Form->input('question', ['type' => 'text', 'readonly' => 'readonly', 'default' => $questions['question']]) ?>
<?php foreach ($questions['correct_answers'] as $key => $correct_answers): ?>
    <!--idが空でなかった場合hiddenで渡す-->
    <!--$this->request->getData() で渡っているため追加の回答枠も含まれる-->
    <?php if (! empty($correct_answers['id'])): ?>
        <?= $this->Form->input("correct_answers.$key.id", ['type' =>'hidden', 'value' => $correct_answers['id']]) ?>
    <?php endif; ?>
        <?= $this->Form->input("correct_answers.$key.answer", [ 'type' => 'text', 'readonly' => 'readonly', 'default' => $correct_answers['answer']]) ?>
<?php endforeach; ?>
<?= $this->Form->button('登録', ['value' => 'save']); ?>
<?= $this->Form->end() ?>
