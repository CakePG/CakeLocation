<?php
use Cake\Core\Configure;

$config = [
  'CakeLocation' => [
    'dashboard_path' => '/admin',
    'limit' => 5,
    'fixed_num' => false,
    'use_flyer' => false,
    'enables' => [
      'name' => true,
      'postal' => true,
      'address' => true,
      'tel' => true,
      'fax' => true,
      'hour' => true,
      'holiday' => true,
      'description' => true,
      'link1' => true,
      'link2' => true,
      'file1' => true,
      'file2' => true
    ],
    'file1' => [
      'fixed' => null,  // 固定にする [横, 縦] で指定。（縦と横は数字で必須。指定した場合、他のサイズ調整は無視）
      'maxwidth' => 2000, // より大きい場合小さくする。（maxwidthとmaxheightは片方のみ影響）
      'maxheight' => null, // より大きい場合小さくする。（maxwidthとmaxheightは片方のみ影響）
      'mask' => null, // png画像からマスクをかけpngファイルに変換する。画像pathを記載する。例:ROOT.DS.'webroot/img/mask.png'
      'quality' => 95 // 加工時の画質
    ],
    'file2' => [
      'fixed' => null,  // 固定にする [横, 縦] で指定。（縦と横は数字で必須。指定した場合、他のサイズ調整は無視）
      'maxwidth' => 2000, // より大きい場合小さくする。（maxwidthとmaxheightは片方のみ影響）
      'maxheight' => null, // より大きい場合小さくする。（maxwidthとmaxheightは片方のみ影響）
      'mask' => null, // png画像からマスクをかけpngファイルに変換する。画像pathを記載する。例:ROOT.DS.'webroot/img/mask.png'
      'quality' => 95 // 加工時の画質
    ]
  ]
];

return $config;
