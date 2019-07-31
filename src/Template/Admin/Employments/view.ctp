<?php
  $this->layout = 'admin';
  $this->assign('title', __d('CakeLocation', 'Location Employment').'詳細 - '.__d('CakeLocation', 'Website Admin Title').' | '.__d('CakeLocation', 'Website Title'));
  $this->assign('keywords', '');
  $this->assign('description', '');
?>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="<?= $dashboardPath ?>"><i class="fa fa-home" aria-hidden="true"></i><?= __d('CakeLocation', 'Dashboard') ?></a></li>
  <li class="breadcrumb-item"><?= $this->Html->link(__d('CakeLocation', 'Location Employment').'一覧', ['action' => 'index']+$this->request->query) ?></li>
  <li class="breadcrumb-item active" aria-current="page"><?= __d('CakeLocation', 'Location Employment') ?>詳細</li>
</ol>

<div class="container">
  <div class="row align-items-end mb-2">
    <div class="col-md">
      <h2><?= __d('CakeLocation', 'Location Employment') ?>詳細<hr class="d-none d-md-block"></h2>
    </div>
    <div class="col-md-auto">
      <nav class="nav nav-pills nav-fill">
        <?= $this->Html->link('<i class="fa fa-pencil" aria-hidden="true"></i>編集', ['action' => 'edit', $employment->id]+$this->request->query, ['class' => 'btn btn-success', 'escape' => false]) ?>
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
        <dt>雇用形態</dt>
        <dd><?= h($employment->name) ?></dd>

        <dt>募集停止<?= __d('CakeLocation', 'Location') ?></dt>
        <dd>
          <?php foreach ($employment->locations as $location) : ?>
            <?= $location->name ?><br>
          <?php endforeach; ?>
        </dd>
      </dl>

      <hr class="mb-2">
      <dl>
        <dt>作成日</dt>
        <dd><?= h($employment->created) ?></dd>

        <dt>更新日</dt>
        <dd><?= h($employment->modified) ?></dd>
      </dl>
    </div>
  </div>
</div>
