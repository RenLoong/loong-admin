<?php

namespace app\admin\controller;

use app\Basic;
use app\expose\build\builder\ComponentBuilder;
use app\expose\build\builder\FormBuilder;
use app\expose\build\builder\TableBuilder;
use app\expose\enum\Action;
use app\expose\enum\ResponseEvent;
use app\expose\enum\State;
use app\expose\helper\Menus;
use app\model\Admin;
use app\model\AdminRole;
use support\Request;

class AdminRoleController extends Basic
{
    public function indexGetTable(Request $request)
    {
        $builder = new TableBuilder([
            'rowKey' => 'id',
            'api' => 'AdminRole/index',
            'lazy' => true,
            'treeProps' => [
                'children' => 'children',
                'hasChildren' => 'hasChildren'
            ]
        ]);
        $builder->addAction('操作', [
            'width' => '200px',
            'fixed' => 'right'
        ]);
        $builder->addTableAction('编辑', [
            'path' => 'AdminRole/update',
            'where' => [
                ['is_system', '!=', 1]
            ],
            'props' => [
                'type' => 'primary',
                'title' => '编辑《{name}》角色'
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
            'path' => 'AdminRole/delete',
            'where' => [
                ['is_system', '!=', 1]
            ],
            'props' => [
                'type' => 'error',
                'message' => '确定要删除《{name}》角色吗？',
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
        $builder->addHeader();
        $builder->addHeaderAction('创建角色', [
            'path' => 'AdminRole/create',
            'props' => [
                'type' => 'success',
                'title' => '创建角色'
            ],
            'component' => [
                'name' => 'button',
                'props' => [
                    'type' => 'success'
                ]
            ]
        ]);
        $builder->add('id', 'ID', [
            'props' => [
                'width' => '80px'
            ]
        ]);
        $builder->add('name', '角色名称');
        $builder->add('admin_num', '人数', [
            'props' => [
                'width' => '120px'
            ]
        ]);
        $builder->add('rule_num', '拥有权限数', [
            'props' => [
                'width' => '120px'
            ]
        ]);
        $builder->add('state', '状态', [
            'component' => [
                'name' => 'switch',
                'api' => 'AdminRole/indexUpdateState',
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
        $id = $request->get('id');
        if ($id) {
            $where[] = ['pid', '=', $id];
        } else {
            $where[] = ['pid', 'NULL', ''];
        }
        $list = AdminRole::where($where)
            ->order('id asc')->paginate($limit)->each(function ($item) {
                $item->admin_num = Admin::where(['role_id' => $item->id])->count();
                $item->rule_num = 0;
                if ($item->is_system) {
                    $item->rule_num = '所有';
                } elseif ($item->rule) {
                    $item->rule_num = count($item->rule);
                }
                $item->hasChildren = AdminRole::where(['pid' => $item->id])->count() > 0;
            });
        return $this->resData($list);
    }
    public function indexUpdateState(Request $request)
    {
        $id = $request->post('id');
        $field = $request->post('field');
        $value = $request->post('value');
        $AdminRole = AdminRole::where(['id' => $id])->find();
        if (!$AdminRole) {
            return $this->fail('角色不存在');
        }
        if ($AdminRole->is_system) {
            return $this->fail('系统角色不允许操作');
        }
        $AdminRole->{$field} = $value;
        if ($AdminRole->save()) {
            return $this->success();
        }
        return $this->fail('操作失败');
    }
    public function delete(Request $request)
    {
        $id = $request->post('id');
        $AdminRole = AdminRole::where(['id' => $id])->find();
        if (!$AdminRole) {
            return $this->fail('角色不存在');
        }
        if ($AdminRole->is_system) {
            return $this->fail('系统角色不允许操作');
        }
        if (AdminRole::where(['pid' => $id])->count() > 0) {
            return $this->fail('请先删除子角色');
        }
        if (Admin::where(['role_id' => $id])->count() > 0) {
            return $this->fail('请先将拥有该角色的用户移除');
        }
        if ($AdminRole->delete()) {
            return $this->success();
        }
        return $this->fail('操作失败');
    }
    public function create(Request $request)
    {
        if ($request->method() === 'POST') {
            $D = $request->post();
            $AdminRole = new AdminRole;
            if (!empty($D['pid'])) {
                $AdminRole->pid = $D['pid'];
            }
            $AdminRole->name = $D['name'];
            $AdminRole->rule = $D['rule'];
            if ($AdminRole->save()) {
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
            $AdminRole = AdminRole::where(['id' => $D['id']])->find();
            if (!$AdminRole) {
                return $this->fail('角色不存在');
            }
            $AdminRole->name = $D['name'];
            $AdminRole->rule = $D['rule'];
            if ($AdminRole->save()) {
                return $this->event(ResponseEvent::UPDATE_USERINFO, '保存成功');
            }
            return $this->fail('保存失败');
        }
        $id = $request->get('id');
        $AdminRole = AdminRole::where(['id' => $id])->find();
        if (!$AdminRole) {
            return $this->fail('角色不存在');
        }
        $builder = $this->getFormBuilder(true);
        if (!$AdminRole->rule) {
            $AdminRole->rule = [];
        }
        $builder->setData($AdminRole->toArray());
        return $this->resData($builder);
    }
    private function getFormBuilder($update = false)
    {
        $builder = new FormBuilder;
        $Component = new ComponentBuilder;
        if (!$update) {
            $builder->add('pid', '角色等级', 'cascader', null, [
                'prompt' => [
                    $Component->add('text', ['default' => '建议使用公司组织架构为角色等级'], ['type' => 'info', 'size' => 'small'])
                        ->builder()
                ],
                'props' => [
                    'options' => AdminRole::options(null, ['is_system' => 0]),
                    'clearable' => true,
                    'filterable' => true,
                    'props' => [
                        'checkStrictly' => true,
                        'emitPath' => false
                    ]
                ]
            ]);
        }
        $builder->add('name', '角色名称', 'input', '', [
            'required' => true,
            'prompt' => [
                $Component->add('text', ['default' => '建议使用公司组织架构为角色名称'], ['type' => 'info', 'size' => 'small'])
                    ->builder()
            ],
            'props' => [
                'maxlength' => 30,
                'show-word-limit' => true
            ]
        ]);
        $Install = new \app\admin\api\Install;
        $menus = new Menus($Install);
        $builder->add('rule', '规则', 'admin-rule', [], [
            'required' => true,
            'options' => $menus,
            'props' => [
                'rightDefaultChecked' => [
                    'Index',
                    'Index/index',
                    'Index/control',
                    'Admin/updateSelf',
                    'Admin/getSelfInfo',
                    'Public',
                    'Public/outLogin'
                ]
            ]
        ]);
        return $builder;
    }
}
