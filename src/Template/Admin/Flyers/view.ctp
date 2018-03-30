<?php
  $this->layout = 'admin';
  $this->assign('title', __d('CakeLocation', 'Location Flyer').'詳細 - '.__d('CakeLocation', 'Website Admin Title').' | '.__d('CakeLocation', 'Website Title'));
  $this->assign('keywords', '');
  $this->assign('description', '');
?>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="<?= $dashboardPath ?>"><i class="fa fa-home" aria-hidden="true"></i><?= __d('CakeLocation', 'Dashboard') ?></a></li>
  <li class="breadcrumb-item"><?= $this->Html->link(__d('CakeLocation', 'Location Flyer').'一覧', ['action' => 'index']+$this->request->query) ?></li>
  <li class="breadcrumb-item active" aria-current="page"><?= __d('CakeLocation', 'Location Flyer') ?>詳細</li>
</ol>

<div class="container">
  <div class="row align-items-end mb-2">
    <div class="col-md">
      <h2><?= __d('CakeLocation', 'Location Flyer') ?>詳細<hr class="d-none d-md-block"></h2>
    </div>
    <div class="col-md-auto">
      <nav class="nav nav-pills nav-fill">
        <?= $this->Html->link('<i class="fa fa-pencil" aria-hidden="true"></i>編集', ['action' => 'edit', $flyer->id]+$this->request->query, ['class' => 'btn btn-success', 'escape' => false]) ?>
        <?php if (!$fixedNum): ?>
          <?= $this->Form->postLink('<i class="fa fa-trash" aria-hidden="true"></i>削除', ['action' => 'delete', $flyer->id]+$this->request->query, ['class' => 'btn btn-danger', 'escape' => false, 'confirm' => '『'.$flyer->name.'』を本当に削除しますか？']) ?>
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
        <dt>状態</dt>
        <dd><?= $flyer->published_msg ?></dd>

        <dt>名前</dt>
        <dd><?= h($flyer->name) ?></dd>

        <dt>掲載期間</dt>
        <dd><?= h($flyer->open_period) ?></dd>

        <dt>掲載<?= __d('CakeLocation', 'Location') ?></dt>
        <dd>
          <?php foreach ($flyer->locations as $location) : ?>
            <?= $location->name ?><br>
          <?php endforeach; ?>
        </dd>

        <dt>画像1</dt>
        <dd>
          <?php if (!empty($flyer->file1)): ?>
            <img class="img-thumbnail" src="<?= $flyer->file1_asset_url ?>" alt="<?= h($flyer->name) ?>">
          <?php else: ?>
            画像がありません
          <?php endif; ?>
        </dd>

        <dt>画像2</dt>
        <dd>
          <?php if (!empty($flyer->file2)): ?>
            <img class="img-thumbnail" src="<?= $flyer->file2_asset_url ?>" alt="<?= h($flyer->name) ?>">
          <?php else: ?>
            画像がありません
          <?php endif; ?>
        </dd>
      </dl>

      <hr class="mb-2">
      <dl>
        <dt>作成日</dt>
        <dd><?= h($flyer->created) ?></dd>

        <dt>更新日</dt>
        <dd><?= h($flyer->modified) ?></dd>
      </dl>
    </div>
  </div>
</div>
