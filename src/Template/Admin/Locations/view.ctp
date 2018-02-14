<?php
  $this->layout = 'admin';
  $this->assign('title', __d('CakeLocation', 'Location').'詳細 - '.__d('CakeLocation', 'Website Admin Title').' | '.__d('CakeLocation', 'Website Title'));
  $this->assign('keywords', '');
  $this->assign('description', '');
?>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="<?= $dashboardPath ?>"><i class="fa fa-home" aria-hidden="true"></i><?= __d('CakeLocation', 'Dashboard') ?></a></li>
  <li class="breadcrumb-item"><?= $this->Html->link(__d('CakeLocation', 'Location').'一覧', ['action' => 'index']+$this->request->query) ?></li>
  <li class="breadcrumb-item active" aria-current="page"><?= __d('CakeLocation', 'Location') ?>詳細</li>
</ol>

<div class="container">
  <div class="row align-items-end mb-2">
    <div class="col-md">
      <h2><?= __d('CakeLocation', 'Location') ?>詳細<hr class="d-none d-md-block"></h2>
    </div>
    <div class="col-md-auto">
      <nav class="nav nav-pills nav-fill">
        <?= $this->Html->link('<i class="fa fa-pencil" aria-hidden="true"></i>編集', ['action' => 'edit', $location->id]+$this->request->query, ['class' => 'btn btn-success', 'escape' => false]) ?>
        <?php if (!$fixedNum): ?>
          <?= $this->Form->postLink('<i class="fa fa-trash" aria-hidden="true"></i>削除', ['action' => 'delete', $location->id]+$this->request->query, ['class' => 'btn btn-danger', 'escape' => false, 'confirm' => '『'.$location->name.'』を本当に削除しますか？']) ?>
        <?php endif; ?>
      </nav>
    </div>
  </div>

  <div class="card admin">
    <div class="card-header">
      <nav class="nav nav-pills nav-fill">
        <?= $this->Html->link('<i class="fa fa-angle-double-left" aria-hidden="true"></i>一覧へ', ['action' => 'index']+$this->request->query, ['class' => 'btn btn-sm btn-light', 'escape' => false]) ?>
      </nav>
    </div>
    <div class="card-body">
      <dl>
        <dt>名前</dt>
        <dd><?= h($location->name) ?></dd>

        <?php if ($enables['postal']): ?>
          <dt>郵便番号</dt>
          <dd><?= h($location->postal) ?></dd>
        <?php endif; ?>

        <?php if ($enables['address']): ?>
          <dt>住所</dt>
          <dd><?= nl2br(h($location->address)) ?></dd>
        <?php endif; ?>

        <?php if ($enables['tel']): ?>
          <dt>電話番号</dt>
          <dd><?= h($location->tel) ?></dd>
        <?php endif; ?>

        <?php if ($enables['fax']): ?>
          <dt>FAX番号</dt>
          <dd><?= h($location->fax) ?></dd>
        <?php endif; ?>

        <?php if ($enables['hour']): ?>
          <dt>営業時間</dt>
          <dd><?= nl2br(h($location->hour)) ?></dd>
        <?php endif; ?>

        <?php if ($enables['holiday']): ?>
          <dt>定休日</dt>
          <dd><?= nl2br(h($location->holiday)) ?></dd>
        <?php endif; ?>

        <?php if ($enables['link1']): ?>
          <dt>リンク1</dt>
          <dd><?= h($location->link1) ?></dd>
        <?php endif; ?>

        <?php if ($enables['link2']): ?>
          <dt>リンク2</dt>
          <dd><?= h($location->link2) ?></dd>
        <?php endif; ?>

        <?php if ($enables['description']): ?>
          <dt>説明</dt>
          <dd><?= nl2br(h($location->description)) ?></dd>
        <?php endif; ?>

        <?php if ($enables['file1']): ?>
          <dt>画像1</dt>
          <dd>
            <?php if (!empty($location->file1)): ?>
              <img class="img-thumbnail" src="<?= $location->file1_asset_url ?>" alt="<?= h($location->name) ?>">
            <?php else: ?>
              画像がありません
            <?php endif; ?>
          </dd>
        <?php endif; ?>

        <?php if ($enables['file2']): ?>
          <dt>画像2</dt>
          <dd>
            <?php if (!empty($location->file2)): ?>
              <img class="img-thumbnail" src="<?= $location->file2_asset_url ?>" alt="<?= h($location->name) ?>">
            <?php else: ?>
              画像がありません
            <?php endif; ?>
          </dd>
        <?php endif; ?>
      </dl>

      <hr class="mb-2">
      <dl>
        <dt>作成日</dt>
        <dd><?= h($location->created) ?></dd>

        <dt>更新日</dt>
        <dd><?= h($location->modified) ?></dd>
      </dl>
    </div>
  </div>
</div>
