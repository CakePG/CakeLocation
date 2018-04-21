<?php
  $this->layout = 'admin';
  $this->assign('title', __d('CakeLocation', 'Location').'編集 - '.__d('CakeLocation', 'Website Admin Title').' | '.__d('CakeLocation', 'Website Title'));
  $this->assign('keywords', '');
  $this->assign('description', '');
?>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="<?= $dashboardPath ?>"><i class="fa fa-home" aria-hidden="true"></i><?= __d('CakeLocation', 'Dashboard') ?></a></li>
  <li class="breadcrumb-item"><?= $this->Html->link(__d('CakeLocation', 'Location').'一覧', ['action' => 'index']+$this->request->query) ?></li>
  <li class="breadcrumb-item active" aria-current="page"><?= __d('CakeLocation', 'Location') ?>編集</li>
</ol>

<div class="container">
  <div class="row align-items-end mb-2">
    <div class="col-md">
      <h2><?= __d('CakeLocation', 'Location') ?>編集<hr class="d-none d-md-block"></h2>
    </div>
    <div class="col-md-auto">
      <nav class="nav nav-pills nav-fill">
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
        <?= $this->Html->link('<i class="fa fa-angle-left" aria-hidden="true"></i>詳細へ', ['action' => 'view', $location->id]+$this->request->query, ['class' => 'btn btn-sm btn-light', 'escape' => false]) ?>
      </nav>
    </div>
    <div class="card-body">
      <?= $this->Form->create($location, ['type' => 'file', 'templates' => 'app_form_bootstrap', 'class' => 'form-img-preview']); ?>
      <?php
        if ($enables['name']) echo $this->Form->control('name',['label' => '名前', 'class' => 'form-control']);
        if ($enables['postal']) echo $this->Form->control('postal',['label' => '郵便番号', 'class' => 'form-control']);
        if ($enables['address']) echo $this->Form->control('address',['label' => '住所', 'class' => 'form-control', 'type' => 'textarea', 'rows' => 3]);
        if ($enables['tel']) echo $this->Form->control('tel',['label' => '電話番号', 'class' => 'form-control']);
        if ($enables['fax']) echo $this->Form->control('fax',['label' => 'FAX番号', 'class' => 'form-control']);
        if ($enables['hour']) echo $this->Form->control('hour',['label' => '営業時間', 'class' => 'form-control', 'type' => 'textarea', 'rows' => 3]);
        if ($enables['holiday']) echo $this->Form->control('holiday',['label' => '定休日', 'class' => 'form-control', 'type' => 'textarea', 'rows' => 2]);
        if ($enables['link1']) echo $this->Form->control('link1',['label' => 'リンク1', 'class' => 'form-control']);
        if ($enables['link2']) echo $this->Form->control('link2',['label' => 'リンク2', 'class' => 'form-control']);
        if ($enables['description']) echo $this->Form->control('description',['label' => '説明', 'class' => 'form-control', 'type' => 'textarea', 'rows' => 6]);
      ?>

      <?php if ($enables['file1']): ?>
        <div class="form-group row mt-2 mb-2">
            <div class="col-md-3 col-form-label">
              <label for="title">画像1</label>
            </div>
            <div class="col-md-8">
              <?php if (!empty($location->file1)): ?>
              <img class="img-thumbnail" id="uploadid1img" src="<?= $location->file1_asset_url ?>" alt="<?= h($location->name) ?>">
              <div class="file-delete row">
                <div class="col">登録済み</div>
                <label class="col-md-auto">
                  <i class="fa fa-trash" aria-hidden="true"></i>
                  <?= $this->Form->control('file1_delete', ['label'=>false, 'class'=>'form-control', 'type'=>'checkbox']); ?>
                </label>
              </div>
              <?php else: ?>
                <img class="img-thumbnail d-none" id="uploadid1img" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" alt="">
              <?php endif; ?>
            </div>
        </div>
        <?= $this->Form->control('file1', ['label'=>false, 'class'=>'form-control', 'type'=>'file', 'id'=>'uploadid1']); ?>
      <?php endif; ?>

      <?php if ($enables['file2']): ?>
        <div class="form-group row mt-2 mb-2">
            <div class="col-md-3 col-form-label">
              <label for="title">画像2</label>
            </div>
            <div class="col-md-8">
              <?php if (!empty($location->file2)): ?>
              <img class="img-thumbnail" id="uploadid2img" src="<?= $location->file2_asset_url ?>" alt="<?= h($location->name) ?>">
              <div class="file-delete row">
                <div class="col">登録済み</div>
                <label class="col-md-auto">
                  <i class="fa fa-trash" aria-hidden="true"></i>
                  <?= $this->Form->control('file2_delete', ['label'=>false, 'class'=>'form-control', 'type'=>'checkbox']); ?>
                </label>
              </div>
              <?php else: ?>
                <img class="img-thumbnail d-none" id="uploadid2img" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" alt="">
              <?php endif; ?>
            </div>
        </div>
        <?= $this->Form->control('file2', ['label'=>false, 'class'=>'form-control', 'type'=>'file', 'id'=>'uploadid2']); ?>
      <?php endif; ?>

      <?= $this->Form->submit('保存', ['class' => 'btn btn-lg btn-primary btn-block']) ?>
      <?= $this->Form->end() ?>
    </div>
  </div>
</div>
