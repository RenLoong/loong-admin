<?php

namespace app\admin\controller;

use app\Basic;
use app\expose\build\builder\ComponentBuilder;
use app\expose\build\builder\FormBuilder;
use app\expose\build\builder\TableBuilder;
use app\expose\enum\Action;
use app\expose\enum\State;
use app\expose\helper\Uploads;
use app\expose\helper\User as HelperUser;
use app\model\User;
use support\Request;

class UserController extends Basic
{
    public function __construct()
    {
        $this->model = new User;
    }
    public function indexGetTable(Request $request)
    {
        $builder = new TableBuilder;
        $builder->addAction('操作', [
            'width' => '200px',
            'fixed' => 'right'
        ]);
        $builder->addTableAction('编辑', [
            'model' => Action::DIALOG['value'],
            'path' => 'User/update',
            'props' => [
                'title' => '编辑《ID：{id}》用户'
            ],
            'component' => [
                'name' => 'button',
                'props' => [
                    'type' => 'primary',
                    'size' => 'small'
                ]
            ]
        ]);
        $builder->addHeader();
        $builder->addHeaderAction('创建用户', [
            'model' => Action::DIALOG['value'],
            'path' => 'User/create',
            'props' => [
                'title' => '创建用户'
            ],
            'component' => [
                'name' => 'button',
                'props' => [
                    'type' => 'success'
                ]
            ]
        ]);
        $formBuilder = new FormBuilder;
        $formBuilder->add('username', '账号', 'input', '', [
            'col' => [
                'xs' => 24,
                'sm' => 12,
                'md' => 8,
                'lg' => 6,
                'xl' => 4
            ],
            'props' => [
                'placeholder' => '账号搜索',
                'clearable' => true
            ]
        ]);
        $formBuilder->add('mobile', '手机号', 'input', '', [
            'col' => [
                'xs' => 24,
                'sm' => 12,
                'md' => 8,
                'lg' => 6,
                'xl' => 4
            ],
            'props' => [
                'placeholder' => '手机号搜索',
                'clearable' => true
            ]
        ]);
        $formBuilder->add('email', '邮箱', 'input', '', [
            'col' => [
                'xs' => 24,
                'sm' => 12,
                'md' => 8,
                'lg' => 6,
                'xl' => 4
            ],
            'props' => [
                'placeholder' => '邮箱搜索',
                'clearable' => true
            ]
        ]);
        $formBuilder->add('puid', '上级UID', 'input', '', [
            'col' => [
                'xs' => 24,
                'sm' => 12,
                'md' => 8,
                'lg' => 6,
                'xl' => 4
            ],
            'props' => [
                'placeholder' => '上级UID搜索',
                'clearable' => true
            ]
        ]);
        $builder->addScreen($formBuilder);
        $builder->add('id', 'ID', [
            'props' => [
                'width' => '80px'
            ]
        ]);
        $builder->add('userinfo', '用户', [
            'component' => [
                'name' => 'table-userinfo',
                'props' => [
                    'nickname' => 'nickname',
                    'avatar' => 'headimg',
                    'info' => 'username',
                    'nicknameTags' => [
                        [
                            'field' => 'new_text',
                            'props' => [
                                'type' => 'danger',
                                'size' => 'small'
                            ]
                        ]
                    ]
                ]
            ],
            'props' => [
                'minWidth' => '300px'
            ]
        ]);
        $builder->add('puserinfo', '上级', [
            'component' => [
                'name' => 'table-userinfo',
                'props' => [
                    'nickname' => 'pnickname',
                    'avatar' => 'pheadimg',
                    'info' => 'puid'
                ]
            ],
            'props' => [
                'width' => '300px'
            ]
        ]);
        $builder->add('contact', '联系方式', [
            'props' => [
                'width' => '280px'
            ],
            'component' => [
                'name' => 'table-times',
                'props' => [
                    'group' => [
                        [
                            'field' => 'mobile',
                            'label' => '手机号'
                        ],
                        [
                            'field' => 'email',
                            'label' => '邮箱'
                        ]
                    ]
                ]
            ]
        ]);
        $builder->add('state', '状态', [
            'component' => [
                'name' => 'switch',
                'api' => 'User/indexUpdateState',
                'props' => [
                    'active-value' => State::YES['value'],
                    'inactive-value' => State::NO['value']
                ]
            ],
            'props' => [
                'width' => '160px'
            ]
        ]);
        $builder->add('online_time', '活动', [
            'props' => [
                'width' => '200px'
            ],
            'component' => [
                'name' => 'table-times',
                'props' => [
                    'group' => [
                        [
                            'field' => 'activation_time',
                            'label' => '激活'
                        ],
                        [
                            'field' => 'login_time',
                            'label' => '登录'
                        ],
                        [
                            'component' => 'tag',
                            'field' => 'login_ip',
                            'label' => '登录IP',
                            'props' => [
                                'size' => 'small',
                            ]
                        ]
                    ]
                ]
            ]
        ]);
        $builder->add('create_time', '时间', [
            'props' => [
                'width' => '200px'
            ],
            'component' => [
                'name' => 'table-times',
                'props' => [
                    'group' => [
                        [
                            'field' => 'create_time',
                            'label' => '创建'
                        ],
                        [
                            'field' => 'update_time',
                            'label' => '更新'
                        ]
                    ]
                ]
            ]
        ]);
        $builder = $builder->builder();
        return $this->resData($builder);
    }
    public function index(Request $request)
    {
        $limit = $request->get('limit', 10);
        $where = [];
        $username = $request->get('username');
        if ($username) {
            $where[] = ['u.username', 'like', "%{$username}%"];
        }
        $mobile = $request->get('mobile');
        if ($mobile) {
            $where[] = ['u.mobile', 'like', "%{$mobile}%"];
        }
        $email = $request->get('email');
        if ($email) {
            $where[] = ['u.email', 'like', "%{$email}%"];
        }
        $puid = $request->get('puid');
        if ($puid) {
            $where[] = ['u.puid', '=', $puid];
        }
        $list = User::alias('u')->where($where)
            ->join('user p', 'u.puid = p.id', 'LEFT')
            ->field('u.*,p.nickname as  pnickname,p.headimg as pheadimg')
            ->order('u.id desc')->paginate($limit)->each(function ($item) {
                if($item->pheadimg){
                    $item->pheadimg=Uploads::url($item->pheadimg);
                }
                if($item->pnickname){
                    $item->pnickname=base64_decode($item->pnickname);
                }
            });
        return $this->resData($list);
    }
    public function create(Request $request)
    {
        if ($request->method() === 'POST') {
            $D = $request->post();
            try {
                HelperUser::create($D);
            } catch (\Throwable $th) {
                return $this->exception($th);
            }
            return $this->success('创建成功');
        }
        $builder = $this->getFormBuilder();
        $Component = new ComponentBuilder;
        $builder->add('activation_time', '激活时间', 'date-picker', null, [
            'prompt' => [
                $Component->add('text', ['default' => '不选择时间则不激活，由用户前台登录后自动激活'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'placeholder' => '选择激活时间',
                'type' => 'datetime',
                'format' => 'YYYY-MM-DD HH:mm:ss',
                'value-format' => 'YYYY-MM-DD HH:mm:ss'
            ]
        ]);
        return $this->resData($builder);
    }
    public function update(Request $request)
    {
        if ($request->method() === 'POST') {
            $D = $request->post();
            try {
                HelperUser::update($D['id'], $D);
            } catch (\Throwable $th) {
                return $this->exception($th);
            }
            return $this->success('更新成功');
        }
        $id = $request->get('id');
        $User = User::where(['id' => $id])->withoutField('password')->find();
        $builder = $this->getFormBuilder();
        $builder->setData($User->toArray());
        return $this->resData($builder);
    }
    private function getFormBuilder()
    {
        $builder = new FormBuilder;
        $builder->add('nickname', '昵称', 'input', '', [
            'required' => true,
            'maxlength' => 30,
            'show-word-limit' => true
        ]);
        $builder->add('headimg', '头像', 'bundle', '', [
            'props' => [
                'accept' => 'image/*',
                'multiple' => 1
            ]
        ]);
        $builder->add('username', '账号', 'input', '', [
            'props' => [
                'maxlength' => 30,
                'show-word-limit' => true
            ]
        ]);
        $builder->add('mobile', '手机号', 'input', '', [
            'props' => [
                'maxlength' => 11,
                'show-word-limit' => true
            ]
        ]);
        $builder->add('password', '密码', 'input', '', [
            'props' => [
                'placeholder' => '不修改密码请留空',
                'maxlength' => 30,
                'show-word-limit' => true
            ]
        ]);
        $builder->add('email', '邮箱', 'input', '', [
            'props' => [
                'maxlength' => 100,
                'show-word-limit' => true
            ]
        ]);
        return $builder;
    }
}
