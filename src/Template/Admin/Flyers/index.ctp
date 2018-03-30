<?php
  $this->layout = 'admin';
  $this->assign('title', __d('CakeLocation', 'Location Flyer').'一覧 - '.__d('CakeLocation', 'Website Admin Title').' | '.__d('CakeLocation', 'Website Title'));
  $this->assign('keywords', '');
  $this->assign('description', '');
?>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="<?= $dashboardPath ?>"><i class="fa fa-home" aria-hidden="true"></i><?= __d('CakeLocation', 'Dashboard') ?></a></li>
  <li class="breadcrumb-item active" aria-current="page"><?= __d('CakeLocation', 'Location Flyer') ?>一覧</li>
</ol>

<div class="container">
  <div class="row align-items-end mb-2">
    <div class="col-md">
      <h2><?= __d('CakeLocation', 'Location Flyer') ?>一覧<hr class="d-none d-md-block"></h2>
    </div>
    <div class="col-md-auto">
      <nav class="nav nav-pills nav-fill">
        <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i>新規登録', ['action' => 'add']+['unclosed'=>1], ['class' => 'btn btn-success', 'escape' => false]) ?>
      </nav>
    </div>
  </div>

  <?= $this->Form->create(null, ['valueSources' => 'query']); ?>
  <div class="row mb-2">
    <div class="col-md">
      <?= $this->Form->control('q', ['label'=>false, 'class'=>'form-control', 'placeholder'=>'名前']); ?>
    </div>
    <div class="col-md-3">
      <?= $this->Form->control('unclosed', ['label'=>false, 'type'=>'hidden', 'value'=>'', 'id'=>'']); ?>
      <?= $this->Form->control('unclosed', ['label'=>" 公開前・公開中のみ表示", 'type'=>'checkbox', 'hiddenField'=>false]); ?>
    </div>
    <div class="col-md-2 mt-2 mt-md-0 text-right">
      <?= $this->Form->button('<i class="fa fa-search" aria-hidden="true"></i> 検索', ['type' => 'submit', 'class'=>'btn btn-dark', 'escapeTitle'=>false]); ?>
      <?= $this->Html->link('<i class="fa fa-refresh" aria-hidden="true"></i>', ['action' => 'index']+['unclosed'=>1], ['class'=>'btn btn-warning', 'escapeTitle'=>false]); ?>
    </div>
  </div>
  <?= $this->Form->end(); ?>

  <table class="table admin">
    <thead>
      <tr>
        <th class="ids">状態</th>
        <th><?= $this->Paginator->sort('name', '題名') ?></th>
        <th><?= $this->Paginator->sort('closed_at', '掲載期間') ?></th>
        <th class="actions">操作</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($flyers as $flyer) : ?>
        <tr>
          <td class="ids"><?= $flyer->published_msg ?></td>
          <td><?= h($flyer->name) ?></td>
          <td><?= h($flyer->open_period) ?></td>
          <td class="actions">
            <?= $this->Html->link('<i class="fa fa-eye" aria-hidden="true"></i>詳細', ['action' => 'view', $flyer->id]+$this->request->query, ['escape' => false]) ?>
            <?= $this->Html->link('<i class="fa fa-pencil" aria-hidden="true"></i>編集', ['action' => 'edit', $flyer->id]+$this->request->query, ['escape' => false]) ?>
            <?php if (!$fixedNum): ?>
              <?= $this->Form->postLink('<i class="fa fa-trash" aria-hidden="true"></i>削除', ['action' => 'delete', $flyer->id]+$this->request->query, ['escape' => false, 'confirm' => '『'.$flyer->name.'』を本当に削除しますか？']) ?>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?= $this->element('pagination') ?>
</div>
