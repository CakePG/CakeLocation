<?php
namespace CakePG\CakeLocation\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;
use Cake\Utility\Text;

class LocationsTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        $this->addBehavior('CakePG/CakeLocation.SortPriority');

        $this->belongsToMany('Flyers', [
            'className' => 'CakePG/CakeLocation.Flyers',
            'joinTable' => 'locations_flyers'
        ]);

        $this->belongsToMany('Employments', [
            'className' => 'CakePG/CakeLocation.Employments',
            'joinTable' => 'locations_employments'
        ]);
        // search
        $this->addBehavior('Search.Search');
        $this->searchManager()
            ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'comparison' => 'LIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
                'field' => [
                    'name', 'address'
                ]
            ]);

        $this->addBehavior('CakePG/CakeLocation.ImageTransformer');
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            // file1
            'file1' => [
                'nameCallback' => function(array $data, array $opts) {
                    $ext = substr(strrchr($data['name'], '.'), 1);
                    return str_replace('-', '', Text::uuid()).'.'.$ext;
                },
                'fields' => [
                    'dir' => 'dir1',
                    'size' => 'size1',
                    'type' => 'type1',
                ],
                'filesystem' => [
                    'root' => '/',
                ],
                'transformer' =>  function ($table, $entity, $data, $field, $settings) {
                    $extension = pathinfo($data['name'], PATHINFO_EXTENSION);
                    $tmp = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;
                    $type = $entity->file1['type'];

                    // 画像でなければスキップ
                    if (!($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/bmp')) {
                      return [$data['tmp_name'] => $data['name']];
                    }

                    $setting = Configure::read('CakeLocation.file1');
                    // 画像加工
                    $tmp = $this->imageTransformer($data, $type, $setting, $tmp);
                    return [
                        $tmp => $data['name']
                    ];
                },
                'path' => STORAGE.'{model}{DS}',
                'deleteCallback' => function ($path, $entity, $field, $settings) {
                    return empty($entity->{$field}) ? [null] : [$path . $entity->{$field}];
                },
                'keepFilesOnDelete' => false,
            ],
            // file2
            'file2' => [
                'nameCallback' => function(array $data, array $opts) {
                    $ext = substr(strrchr($data['name'], '.'), 1);
                    return str_replace('-', '', Text::uuid()).'.'.$ext;
                },
                'fields' => [
                    'dir' => 'dir2',
                    'size' => 'size2',
                    'type' => 'type2',
                ],
                'filesystem' => [
                    'root' => '/',
                ],
                'transformer' =>  function ($table, $entity, $data, $field, $settings) {
                    $extension = pathinfo($data['name'], PATHINFO_EXTENSION);
                    $tmp = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;
                    $type = $entity->file2['type'];

                    // 画像でなければスキップ
                    if (!($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/bmp')) {
                      return [$data['tmp_name'] => $data['name']];
                    }

                    $setting = Configure::read('CakeLocation.file2');
                    // 画像加工
                    $tmp = $this->imageTransformer($data, $type, $setting, $tmp);
                    return [
                        $tmp => $data['name']
                    ];
                },
                'path' => STORAGE.'{model}{DS}',
                'deleteCallback' => function ($path, $entity, $field, $settings) {
                    return empty($entity->{$field}) ? [null] : [$path . $entity->{$field}];
                },
                'keepFilesOnDelete' => false,
            ]
        ]);
    }

    public function beforeSave($event, $entity, $options)
    {
        // 画像でmaskを使ってる場合はpngに変換する
        if (($entity->type1 == 'image/jpeg' || $entity->type1 == 'image/png' || $entity->type1 == 'image/bmp') && Configure::read('CakeLocation.file1.mask')) {
            $entity->type1 = 'image/png';
        }
        if (($entity->type2 == 'image/jpeg' || $entity->type2 == 'image/png' || $entity->type2 == 'image/bmp') && Configure::read('CakeLocation.file2.mask')) {
            $entity->type2 = 'image/png';
        }
        // 画像が差し替えられたか、deleteがtrueの画像を削除する
        if (!$entity->isNew()) {
          if ($entity->file1 != $entity->getOriginal('file1') && !empty($entity->getOriginal('file1'))) {
            unlink($entity->getOriginal('dir1').$entity->getOriginal('file1'));
          } else if ($entity->file1_delete && !empty($entity->getOriginal('file1'))) {
            unlink($entity->getOriginal('dir1').$entity->getOriginal('file1'));
            $entity->file1 = null;
            $entity->dir1 = null;
            $entity->size1 = null;
            $entity->type1 = null;
          }
          if ($entity->file2 != $entity->getOriginal('file2') && !empty($entity->getOriginal('file2'))) {
            unlink($entity->getOriginal('dir2').$entity->getOriginal('file2'));
          } else if ($entity->file2_delete && !empty($entity->getOriginal('file2'))) {
            unlink($entity->getOriginal('dir2').$entity->getOriginal('file2'));
            $entity->file2 = null;
            $entity->dir2 = null;
            $entity->size2 = null;
            $entity->type2 = null;
          }
        }
        return true;
    }
    public function validationDefault(Validator $validator)
    {
        return $validator
            ->allowEmpty('name')
            ->allowEmpty('postal')
            ->allowEmpty('address')
            ->allowEmpty('tel')
            ->allowEmpty('fax')
            ->allowEmpty('hour')
            ->allowEmpty('holiday')
            ->allowEmpty('description')
            ->allowEmpty('link1')
            ->allowEmpty('link2')

            ->maxLength('name', 50, '50字以内で入力して下さい。')
            ->add('postal', 'custom', [
                'rule' => function ($value, $context) {
                    return (bool) preg_match('/^([0-9]{3}-[0-9]{4})?$|^[0-9]{7}+$/', $value);
                },
                'message' => '7桁の半角数字とハイフンで入力して下さい。'
            ])
            ->maxLength('address', 250, '250字以内で入力して下さい。')
            ->add('tel', 'custom', [
                'rule' => function ($value, $context) {
                    return (bool) preg_match('/^[0-9]{2,5}-?[0-9]{2,5}-?[0-9]{2,5}$/', $value);
                },
                'message' => '電話番号の値が不正です'
            ])
            ->add('fax', 'custom', [
                'rule' => function ($value, $context) {
                    return (bool) preg_match('/^[0-9]{2,5}-?[0-9]{2,5}-?[0-9]{2,5}$/', $value);
                },
                'message' => 'FAX番号の値が不正です'
            ])
            ->maxLength('hour', 250, '250字以内で入力して下さい。')
            ->maxLength('holiday', 250, '250字以内で入力して下さい。')
            ->maxLength('description', 1000, '1000字以内で入力して下さい。')
            ->maxLength('link1', 250, '250字以内で入力して下さい。')
            ->maxLength('link2', 250, '250字以内で入力して下さい。')

            ->allowEmpty('file1')
            ->allowEmpty('dir1')
            ->allowEmpty('size1')
            ->allowEmpty('type1')
            ->allowEmpty('file2')
            ->allowEmpty('dir2')
            ->allowEmpty('size2')
            ->allowEmpty('type2')

            ->provider('upload', \Josegonzalez\Upload\Validation\UploadValidation::class)
            ->add('file1', 'fileUnderPhpSizeLimit', [
                'rule' => 'isUnderPhpSizeLimit',
                'message' => 'サーバーで許可されていないファイルサイズです。',
                'provider' => 'upload'
            ])
            ->add('file1', 'fileUnderFormSizeLimit', [
                'rule' => 'isUnderFormSizeLimit',
                'message' => 'フォームで許可されていないファイルサイズです。',
                'provider' => 'upload'
            ])
            ->add('file1', 'fileBelowMaxSize', [
                'rule' => ['isBelowMaxSize', 10000000],
                'message' => 'ファイルサイズ制限の10MBを超えています。',
                'provider' => 'upload'
            ])
            ->add('file1', 'file', [
                'rule' => ['mimeType', [
                    'image/jpeg',
                    'image/png',
                    'image/bmp',
                    'image/gif'
                ]],
                'message' => '許可されていないファイルタイプです。',
                'on' => function ($context) {
                    return !empty($context['data']['file1']['type']);
                }
            ])

            ->add('file2', 'fileUnderPhpSizeLimit', [
                'rule' => 'isUnderPhpSizeLimit',
                'message' => 'サーバーで許可されていないファイルサイズです。',
                'provider' => 'upload'
            ])
            ->add('file2', 'fileUnderFormSizeLimit', [
                'rule' => 'isUnderFormSizeLimit',
                'message' => 'フォームで許可されていないファイルサイズです。',
                'provider' => 'upload'
            ])
            ->add('file2', 'fileBelowMaxSize', [
                'rule' => ['isBelowMaxSize', 10000000],
                'message' => 'ファイルサイズ制限の10MBを超えています。',
                'provider' => 'upload'
            ])
            ->add('file2', 'file', [
                'rule' => ['mimeType', [
                    'image/jpeg',
                    'image/png',
                    'image/bmp',
                    'image/gif'
                ]],
                'message' => '許可されていないファイルタイプです。',
                'on' => function ($context) {
                    return !empty($context['data']['file2']['type']);
                }
            ]);
    }
}
