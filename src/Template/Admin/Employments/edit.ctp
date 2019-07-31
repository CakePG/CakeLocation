<?php
  $this->layout = 'admin';
  $this->assign('title', __d('CakeLocation', 'Location Employment').'編集 - '.__d('CakeLocation', 'Website Admin Title').' | '.__d('CakeLocation', 'Website Title'));
  $this->assign('keywords', '');
  $this->assign('description', '');
?>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="<?= $dashboardPath ?>"><i class="fa fa-home" aria-hidden="true"></i><?= __d('CakeLocation', 'Dashboard') ?></a></li>
  <li class="breadcrumb-item"><?= $this->Html->link(__d('CakeLocation', 'Location Employment').'一覧', ['action' => 'index']+$this->request->query) ?></li>
  <li class="breadcrumb-item active" aria-current="page"><?= __d('CakeLocation', 'Location Employment') ?>編集</li>
</ol>

<div class="container">
  <div class="row align-items-end mb-2">
    <div class="col-md">
      <h2><?= __d('CakeLocation', 'Location Employment') ?>編集<hr class="d-none d-md-block"></h2>
    </div>
    <div class="col-md-auto">
      <nav class="nav nav-pills nav-fill">
      </nav>
    </div>
  </div>

  <div class="card admin">
    <div class="card-header">
      <nav class="nav nav-pills nav-fill">
        <?= $this->Html->link('<i class="fa fa-angle-double-left" aria-hidden="true"></i>一覧へ', ['action' => 'index']+$this->request->query, ['class' => 'btn btn-sm btn-light', 'escape' => false]) ?>
        <?= $this->Html->link('<i class="fa fa-angle-left" aria-hidden="true"></i>詳細へ', ['action' => 'view', $employment->id]+$this->request->query, ['class' => 'btn btn-sm btn-light', 'escape' => false]) ?>
      </nav>
    </div>
    <div class="card-body">
      <?= $this->Form->create($employment, ['type' => 'file', 'templates' => 'app_form_bootstrap']); ?>
      <?php
        echo $this->Form->control('name',['label' => '雇用形態', 'class' => 'form-control', 'readonly' => 'readonly']);
      ?>
      <div class="form-group row mt-2 mb-0">
          <div class="col-md-3 col-form-label">
            <label class="mb-0" for="title">募集停止<?= __d('CakeLocation', 'Location') ?></label>
          </div>
          <div class="col-md-8 pt-1">
            <a href="#bulk_check" class="bulk-check-all btn btn-sm btn-primary"><i class="fa fa-check-square" aria-hidden="true"></i>全チェック</a>
            <a href="#bulk_check_clear" class="bulk-check-clear btn btn-sm btn-secondary"><i class="fa fa-square-o" aria-hidden="true"></i>全解除</a>
          </div>
      </div>
      <div class="bulk-check"><?= $this->Form->control('locations._ids', ['label' => false, 'type' => 'multicheckbox', 'options' => $locations]); ?></div>

      <?= $this->Form->submit('保存', ['class' => 'btn btn-lg btn-primary btn-block']) ?>
      <?= $this->Form->end() ?>
    </div>
  </div>
</div>
