<?php
  $this->layout = 'admin';
  $this->assign('title', __d('CakeLocation', 'Location Flyer').'編集 - '.__d('CakeLocation', 'Website Admin Title').' | '.__d('CakeLocation', 'Website Title'));
  $this->assign('keywords', '');
  $this->assign('description', '');
?>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="<?= $dashboardPath ?>"><i class="fa fa-home" aria-hidden="true"></i><?= __d('CakeLocation', 'Dashboard') ?></a></li>
  <li class="breadcrumb-item"><?= $this->Html->link(__d('CakeLocation', 'Location Flyer').'一覧', ['action' => 'index']+$this->request->query) ?></li>
  <li class="breadcrumb-item active" aria-current="page"><?= __d('CakeLocation', 'Location Flyer') ?>編集</li>
</ol>

<div class="container">
  <div class="row align-items-end mb-2">
    <div class="col-md">
      <h2><?= __d('CakeLocation', 'Location Flyer') ?>編集<hr class="d-none d-md-block"></h2>
    </div>
    <div class="col-md-auto">
      <nav class="nav nav-pills nav-fill">
        <?= $this->Form->postLink('<i class="fa fa-trash" aria-hidden="true"></i>削除', ['action' => 'delete', $flyer->id]+$this->request->query, ['class' => 'btn btn-danger', 'escape' => false, 'confirm' => '『'.$flyer->name.'』を本当に削除しますか？']) ?>
      </nav>
    </div>
  </div>

  <div class="card admin">
    <div class="card-header">
      <nav class="nav nav-pills nav-fill">
        <?= $this->Html->link('<i class="fa fa-angle-double-left" aria-hidden="true"></i>一覧へ', ['action' => 'index']+$this->request->query, ['class' => 'btn btn-sm btn-light', 'escape' => false]) ?>
        <?= $this->Html->link('<i class="fa fa-angle-left" aria-hidden="true"></i>詳細へ', ['action' => 'view', $flyer->id]+$this->request->query, ['class' => 'btn btn-sm btn-light', 'escape' => false]) ?>
      </nav>
    </div>
    <div class="card-body">
      <?= $this->Form->create($flyer, ['type' => 'file', 'templates' => 'app_form_bootstrap']); ?>
      <?php
        echo $this->Form->control('name',['label' => '題名', 'class' => 'form-control']);
        echo $this->Form->control('opened_at',['label' => '掲載開始日時', 'type' => 'text', 'class' => 'form-control flattimepickr']);
        echo $this->Form->control('closed_at',['label' => '掲載終了日時', 'type' => 'text', 'class' => 'form-control flattimepickr']);
        echo $this->Form->control('locations._ids', ['label' => '掲載'.__d('CakeLocation', 'Location'), 'type' => 'multicheckbox', 'options' => $locations]);
      ?>

      <div class="form-group row mt-2 mb-2">
          <div class="col-md-3 col-form-label">
            <label for="title">画像1</label>
          </div>
          <div class="col-md-8">
            <?php if (!empty($flyer->file1)): ?>
            <img class="img-thumbnail" src="<?= $flyer->file1_asset_url ?>" alt="<?= h($flyer->name) ?>">
            <div class="file-delete row">
              <div class="col">登録済み</div>
              <label class="col-md-auto">
                <i class="fa fa-trash" aria-hidden="true"></i>
                <?= $this->Form->control('file1_delete', ['label'=>false, 'class'=>'form-control', 'type'=>'checkbox']); ?>
              </label>
            </div>
            <?php endif; ?>
          </div>
      </div>
      <?= $this->Form->control('file1', ['label'=>false, 'class'=>'form-control', 'type'=>'file']); ?>

      <div class="form-group row mt-2 mb-2">
          <div class="col-md-3 col-form-label">
            <label for="title">画像2</label>
          </div>
          <div class="col-md-8">
            <?php if (!empty($flyer->file2)): ?>
            <img class="img-thumbnail" src="<?= $flyer->file2_asset_url ?>" alt="<?= h($flyer->name) ?>">
            <div class="file-delete row">
              <div class="col">登録済み</div>
              <label class="col-md-auto">
                <i class="fa fa-trash" aria-hidden="true"></i>
                <?= $this->Form->control('file2_delete', ['label'=>false, 'class'=>'form-control', 'type'=>'checkbox']); ?>
              </label>
            </div>
            <?php endif; ?>
          </div>
      </div>
      <?= $this->Form->control('file2', ['label'=>false, 'class'=>'form-control', 'type'=>'file']); ?>

      <?= $this->Form->submit('保存', ['class' => 'btn btn-lg btn-primary btn-block']) ?>
      <?= $this->Form->end() ?>
    </div>
  </div>
</div>
