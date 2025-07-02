<?php

namespace app\admin\controller;

use app\Basic;
use app\expose\build\builder\FormBuilder;
use app\expose\build\builder\TableBuilder;
use app\expose\enum\Action;
use app\expose\enum\ResponseEvent;
use app\expose\enum\State;
use app\expose\enum\Week;
use app\model\Admin;
use app\model\AdminRole;
use app\validate\Admin as ValidateAdmin;
use support\Request;
use think\facade\Db;

class AdminController extends Basic
{
    public function indexGetTable(Request $request)
    {
        $builder = new TableBuilder;
        $builder->addAction('操作', [
            'width' => '200px',
            'fixed' => 'right'
        ]);
        $builder->addTableAction('编辑', [
            'path' => 'Admin/update',
            'props' => [
                'type' => 'primary',
                'title' => '编辑《{nickname}》管理员'
            ],
            'component' => [
                'name' => 'button',
                'props' => [
                    'type' => 'primary',
                    'size' => 'small'
                ]
            ]
        ]);
        $builder->addTableAction('删除', [
            'model' => Action::COMFIRM['value'],
            'path' => 'Admin/delete',
            'where' => [
                ['is_system', '!=', 1]
            ],
            'props' => [
                'type' => 'error',
                'message' => '确定要删除《{nickname}》管理员吗？',
                'confirmButtonClass' => 'el-button--danger'
            ],
            'component' => [
                'name' => 'button',
                'props' => [
                    'type' => 'danger',
                    'size' => 'small'
                ]
            ]
        ]);
        $builder->addFooter();
        $builder->addFooterAction('移动到', [
            'model' => Action::DIALOG['value'],
            'path' => 'Admin/moveRole',
            'props' => [
                'type' => 'primary',
                'title' => '移动到',
                'customStyle' => [
                    '--el-messagebox-width' => '300px'
                ]
            ],
            'component' => [
                'name' => 'button',
                'props' => [
                    'type' => 'primary'
                ]
            ]
        ]);
        $builder->addHeader();
        $builder->addHeaderAction('创建管理员', [
            'path' => 'Admin/create',
            'props' => [
                'type' => 'success',
                'title' => '创建管理员'
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
        $builder->addScreen($formBuilder);
        $builder->add('id', 'ID', [
            'props' => [
                'width' => '80px'
            ]
        ]);
        $builder->add('userinfo', '管理员', [
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
                        ],
                        [
                            'field' => 'new_text1',
                            'props' => [
                                'type' => 'success',
                                'size' => 'small'
                            ]
                        ]
                    ],
                    'tags' => [
                        [
                            'field' => 'role_name',
                            'props' => [
                                'type' => 'success'
                            ]
                        ]
                    ],
                ]
            ],
            'props' => [
                'minWidth' => '300px'
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
                        ],
                        [
                            'field' => 'wx_openid',
                            'label' => 'OpenID'
                        ]
                    ]
                ]
            ]
        ]);
        $builder->add('allow_week', '工作日', [
            'component' => [
                'name' => 'tag',
                'options' => Week::getOptions()
            ],
            'props' => [
                'width' => '240px'
            ]
        ]);
        $builder->add('allow_work', '工作时间', [
            'component' => [
                'name' => 'tag',
                'options' => [
                    [
                        'index' => 0,
                        'props' => [
                            'type' => 'success'
                        ]
                    ],
                    [
                        'index' => 1,
                        'props' => [
                            'type' => 'danger'
                        ]
                    ]
                ]
            ],
            'props' => [
                'width' => '200px'
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
                            'field' => 'online_time',
                            'label' => '在线'
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
        $builder->add('state', '状态', [
            'component' => [
                'name' => 'switch',
                'api' => 'Admin/indexUpdateState',
                'props' => [
                    'active-value' => State::YES['value'],
                    'inactive-value' => State::NO['value']
                ]
            ],
            'props' => [
                'width' => '100px'
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
            $where[] = ['username', 'like', "%{$username}%"];
        }
        $mobile = $request->get('mobile');
        if ($mobile) {
            $where[] = ['mobile', 'like', "%{$mobile}%"];
        }
        $list = Admin::alias('a')->where($where)
            ->join('admin_role b', 'b.id=a.role_id')
            ->field('a.*,b.name as role_name,b.is_system')
            ->order('a.id desc')->paginate($limit)->each(function ($item) {
                $item->username = "UserName：" . $item->username;
                $item->new_text = '新';
                $item->new_text1 = 'T';
                $allow_work = [];
                $allow_work[] = $item->allow_time_start;
                $allow_work[] = $item->allow_time_end;
                $item->allow_work = $allow_work;
            });
        return $this->resData($list);
    }
    public function indexUpdateState(Request $request)
    {
        $id = $request->post('id');
        $field = $request->post('field');
        $value = $request->post('value');
        $Admin = Admin::where(['id' => $id])->find();
        if (!$Admin) {
            return $this->fail('管理员不存在');
        }
        $Role = AdminRole::where(['id' => $Admin->role_id])->find();
        if ($Role && $Role->is_system && !$value) {
            return $this->fail('系统管理员不允许操作');
        }
        $Admin->{$field} = $value;
        if ($Admin->save()) {
            return $this->success();
        }
        return $this->fail('操作失败');
    }
    public function delete(Request $request)
    {
        $id = $request->post('id');
        $Admin = Admin::where(['id' => $id])->find();
        if (!$Admin) {
            return $this->fail('管理员不存在');
        }
        $Role = AdminRole::where(['id' => $Admin->role_id])->find();
        if ($Role && $Role->is_system) {
            return $this->fail('系统管理员不允许操作');
        }
        if ($Admin->delete()) {
            return $this->success();
        }
        return $this->fail('操作失败');
    }
    public function create(Request $request)
    {
        if ($request->method() === 'POST') {
            $D = $request->post();
            try {
                $validate = new ValidateAdmin;
                $validate->check($D);
            } catch (\Throwable $th) {
                return $this->exception($th);
            }
            $Role = AdminRole::where(['id' => $D['role_id']])->find();
            if (!$Role) {
                return $this->fail('角色不存在');
            }
            $Admin = new Admin;
            $Admin->role_id = $D['role_id'];
            $Admin->username = $D['username'];
            $Admin->nickname = $D['nickname'];
            $Admin->headimg = $D['headimg'];
            $Admin->mobile = $D['mobile'];
            $Admin->email = $D['email'];
            $Admin->wx_openid = $D['wx_openid'];
            if ($D['password']) {
                $Admin->password = $D['password'];
            }
            if ($Role->is_system) {
                $Admin->allow_time_start = '00:00:00';
                $Admin->allow_time_end = '23:59:59';
                $Admin->allow_week = Week::getValues();
            } else {
                $Admin->allow_time_start = $D['allow_time'][0];
                $Admin->allow_time_end = $D['allow_time'][1];
                $Admin->allow_week = $D['allow_week'];
            }
            if ($Admin->save()) {
                return $this->event(ResponseEvent::UPDATE_USERINFO, '保存成功');
            }
            return $this->fail('保存失败');
        }
        $builder = $this->getFormBuilder();
        return $this->resData($builder);
    }
    public function update(Request $request)
    {
        if ($request->method() === 'POST') {
            $D = $request->post();
            try {
                $validate = new ValidateAdmin;
                $validate->check($D);
            } catch (\Throwable $th) {
                return $this->exception($th);
            }
            $Admin = Admin::where(['id' => $D['id']])->find();
            if (!$Admin) {
                return $this->fail('管理员不存在');
            }
            $Role = AdminRole::where(['id' => $D['role_id']])->find();
            if (!$Role) {
                return $this->fail('角色不存在');
            }
            $Admin->role_id = $D['role_id'];
            $Admin->username = $D['username'];
            $Admin->nickname = $D['nickname'];
            $Admin->headimg = $D['headimg'];
            $Admin->mobile = $D['mobile'];
            $Admin->email = $D['email'];
            $Admin->wx_openid = $D['wx_openid'];
            if ($D['password']) {
                $Admin->password = $D['password'];
            }
            $Admin->allow_time_start = $D['allow_time'][0];
            $Admin->allow_time_end = $D['allow_time'][1];
            $Admin->allow_week = $D['allow_week'];
            if ($Admin->save()) {
                return $this->event(ResponseEvent::UPDATE_USERINFO, '保存成功');
            }
            return $this->fail('保存失败');
        }
        $id = $request->get('id');
        $Admin = Admin::where(['id' => $id])->withoutField('password')->find();
        $Role = AdminRole::where(['id' => $Admin->role_id])->find();
        if (!$Role) {
            $Admin->role_id = '';
        }
        $is_system = $Role && $Role->is_system;
        $builder = $this->getFormBuilder($is_system);
        $Admin->allow_time = [
            $Admin->allow_time_start,
            $Admin->allow_time_end
        ];
        $builder->setData($Admin->toArray());
        return $this->resData($builder);
    }
    private function getFormBuilder($is_system = false)
    {
        $builder = new FormBuilder;
        $builder->add('role_id', '所属角色', 'cascader', null, [
            'required' => true,
            'props' => [
                'options' => AdminRole::options(),
                'filterable' => true,
                'props' => [
                    'checkStrictly' => true,
                    'emitPath' => false
                ]
            ]
        ]);
        $builder->add('username', '账号', 'input', '', [
            'required' => true,
            'props' => [
                'maxlength' => 30,
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
        $builder->add('mobile', '手机号', 'input', '', [
            'props' => [
                'maxlength' => 11,
                'show-word-limit' => true
            ]
        ]);
        $builder->add('email', '邮箱', 'input', '', [
            'props' => [
                'maxlength' => 50,
                'show-word-limit' => true
            ]
        ]);
        $SystemRoleId = AdminRole::systemRole('id');
        $builder->add('allow_time', '工作时间范围', 'time-picker', $is_system ? ['00:00:00', '23:59:59'] : ['08:00:00', '18:00:00'], [
            'where' => [
                ['role_id', 'not in', $SystemRoleId]
            ],
            'props' => [
                'is-range' => true,
                'value-format' => 'HH:mm:ss',
                'disabled' => $is_system
            ]
        ]);
        $builder->add('allow_week', '工作日', 'checkbox', [], [
            'options' => Week::getOptions(),
            'where' => [
                ['role_id', 'not in', $SystemRoleId]
            ],
            'subProps' => [
                'border' => true,
                'disabled' => $is_system
            ]
        ]);
        $builder->add('wx_openid', 'OpenID', 'input', '', []);
        return $builder;
    }
    public function moveRole(Request $request)
    {
        if ($request->method() === 'POST') {
            $D = $request->post();
            if (!$D['role_id']) {
                return $this->fail('请选择角色');
            }
            $Role = AdminRole::where(['id' => $D['role_id']])->find();
            if (!$Role) {
                return $this->fail('角色不存在');
            }
            $ids = explode(',', $D['id']);
            $Admin = Admin::whereIn('id', $ids)->select();
            Db::startTrans();
            try {
                foreach ($Admin as $item) {
                    $item->role_id = $D['role_id'];
                    $item->save();
                }
                Db::commit();
            } catch (\Throwable $th) {
                Db::rollback();
                return $this->exception($th);
            }
            return $this->event(ResponseEvent::UPDATE_USERINFO, '保存成功');
        }
        $builder = new FormBuilder;
        $builder->add('role_id', '所属角色', 'cascader', null, [
            'required' => true,
            'props' => [
                'options' => AdminRole::options(),
                'filterable' => true,
                'props' => [
                    'checkStrictly' => true,
                    'emitPath' => false
                ]
            ]
        ]);
        return $this->resData($builder);
    }
    public function updateSelf(Request $request)
    {
        $id = $request->admin_uid;
        if ($request->method() === 'POST') {
            $D = $request->post();
            $D['id'] = $id;
            try {
                $validate = new ValidateAdmin;
                $validate->scene('self')->check($D);
            } catch (\Throwable $th) {
                return $this->exception($th);
            }
            $Admin = Admin::where(['id' => $D['id']])->find();
            if (!$Admin) {
                return $this->fail('管理员不存在');
            }
            $Admin->username = $D['username'];
            $Admin->nickname = $D['nickname'];
            $Admin->headimg = $D['headimg'];
            $Admin->mobile = $D['mobile'];
            $Admin->email = $D['email'];
            $Admin->wx_openid = $D['wx_openid'];
            if ($D['password']) {
                $Admin->password = $D['password'];
            }
            if ($Admin->save()) {
                return $this->event(ResponseEvent::UPDATE_USERINFO, '保存成功');
            }
            return $this->fail('保存失败');
        }
        $Admin = Admin::where(['id' => $id])->withoutField('password')->find();
        if (!$Admin) {
            return $this->fail('管理员不存在');
        }
        $builder = $this->getFormBuilder();
        $builder->remove('role_id');
        $builder->remove('allow_time');
        $builder->remove('allow_week');
        $builder->setData($Admin->toArray());
        return $this->resData($builder);
    }
    public function getSelfInfo(Request $request)
    {
        $id = $request->admin_uid;
        $Admin = Admin::where(['id' => $id])->withoutField('password')->find();
        if (!$Admin) {
            return $this->fail('管理员不存在');
        }
        return $this->resData(Admin::getTokenInfo($Admin));
    }
}
