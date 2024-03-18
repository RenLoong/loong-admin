<?php

namespace app\expose\trait;

use app\expose\enum\Filesystem;
use app\model\Uploads as ModelUploads;
use app\model\UploadsClassify;
use Shopwwi\WebmanFilesystem\Facade\Storage;
use support\Request;

trait Uploads
{
    protected $admin_uid;
    protected $uid;
    public function getList(Request $request)
    {
        $limit = $request->get('limit', 10);
        $dir_name = $request->get('dir_name', 'all');
        $where = [];
        if ($dir_name != 'all') {
            $where[] = ['c.dir_name', '=', $dir_name];
        }
        $accept = $request->get('accept');
        if ($accept) {
            # 替换掉*号
            $accept = str_replace('*', '', $accept);
            $where[] = ['u.mime', 'like', "%{$accept}%"];
        }
        if ($this->uid) {
            $where[] = ['u.uid', '=', $this->uid];
        }
        if ($this->admin_uid) {
            $where[] = ['u.admin_uid', '=', $this->admin_uid];
        }
        $ModelUploads = ModelUploads::alias('u')->where($where)
            ->join('uploads_classify c', 'u.classify_id=c.id')
            ->field('u.*,c.title as classify_title')
            ->order('u.id desc')
            ->paginate($limit)->each(function ($item) {
                $item->url = Storage::adapter($item->channels)->url($item->path);
                return $item;
            });
        return $this->resData($ModelUploads);
    }
    public function upload(Request $request)
    {
        $dir_name = $request->post('dir_name');
        $dir_title = $request->post('dir_title');
        $UploadsClassify = UploadsClassify::where('dir_name', $dir_name)->find();
        if (!$UploadsClassify) {
            $UploadsClassify = UploadsClassify::where(['dir_name' => 'uploads/default', 'is_system' => 1])->find();
            if (!$UploadsClassify) {
                if (empty($dir_title)) {
                    return $this->fail('分类不存在');
                }
                $UploadsClassify = new UploadsClassify;
                $UploadsClassify->title = $dir_title;
                $UploadsClassify->dir_name = $dir_name;
                $UploadsClassify->channels = Filesystem::PUBLIC['value'];
                $UploadsClassify->save();
            }
        }
        $channels = $request->post('channels');
        if (!$channels) {
            $channels = $UploadsClassify->channels;
        }
        $date_path = date('Ymd');
        //单文件上传
        $file = $request->file('file');
        try {
            $result = Storage::adapter($channels)->path($dir_name . '/' . $date_path)->upload($file);
        } catch (\Throwable $th) {
            return $this->exception($th);
        }
        try {
            $Uploads = new ModelUploads;
            $Uploads->uid = $this->uid;
            $Uploads->admin_uid = $this->admin_uid;
            $Uploads->classify_id = $UploadsClassify->id;
            $Uploads->filename = $result->origin_name;
            $Uploads->path = $result->file_name;
            $Uploads->ext = $result->extension;
            $Uploads->mime = $result->mime_type;
            $Uploads->size = $result->size;
            $Uploads->channels = $channels;
            $Uploads->save();
        } catch (\Throwable $th) {
            return $this->exception($th);
        }
        return $this->resData([
            'id' => $Uploads->id,
            'url' => $result->file_url,
            'path' => $result->file_name,
            'mime' => $result->mime_type,
            'dir_name' => $dir_name
        ]);
    }
    public function deleteUploads(Request $request)
    {
        $ids = $request->post('ids');
        $data = ModelUploads::whereIn('id', $ids)->select();
        foreach ($data as $item) {
            if ($item->uid != $this->uid && $item->admin_uid != $this->admin_uid) {
                continue;
            }
            $item->delete();
            try {
                Storage::adapter($item->channels)->delete($item->path);
            } catch (\Throwable $th) {
            }
        }
        return $this->success('删除成功');
    }
    public function updateUploads(Request $request)
    {
        $ids = $request->post('ids');
        $dir_name = $request->post('dir_name');
        $UploadsClassify = UploadsClassify::where('dir_name', $dir_name)->find();
        if (!$UploadsClassify) {
            return $this->fail('分类不存在');
        }
        $data = ModelUploads::whereIn('id', $ids)->select();
        foreach ($data as $item) {
            if ($item->uid != $this->uid && $item->admin_uid != $this->admin_uid) {
                continue;
            }
            $item->classify_id = $UploadsClassify->id;
            $item->save();
        }
        return $this->success('修改成功');
    }
    public function getUploadClassify(Request $request)
    {
        if (!UploadsClassify::where(['dir_name' => 'uploads/default', 'is_system' => 1])->count()) {
            $UploadsClassify = new UploadsClassify;
            $UploadsClassify->title = '默认分类';
            $UploadsClassify->dir_name = 'uploads/default';
            $UploadsClassify->channels = Filesystem::PUBLIC['value'];
            $UploadsClassify->sort = 0;
            $UploadsClassify->is_system = 1;
            $UploadsClassify->save();
        }
        $UploadsClassify = UploadsClassify::order('sort asc,id asc')->select()->toArray();
        $all = [
            'title' => '全部',
            'dir_name' => 'all',
            'is_system' => 1,
        ];
        array_unshift($UploadsClassify, $all);
        return $this->resData($UploadsClassify);
    }
    public function saveClassify(Request $request)
    {
        $data = $request->post();
        if (empty($data['title'])) {
            return $this->fail('标题不能为空');
        }
        if (empty($data['channels'])) {
            return $this->fail('请选择储存渠道');
        }
        if (empty($data['dir_name'])) {
            return $this->fail('目录名不能为空');
        }
        $UploadsClassify = UploadsClassify::where('dir_name', $data['dir_name'])->find();
        if (!$UploadsClassify) {
            $UploadsClassify = new UploadsClassify;
            $UploadsClassify->dir_name = 'uploads/' . $data['dir_name'];
        }
        $UploadsClassify->title = $data['title'];
        $UploadsClassify->channels = $data['channels'];
        if (!empty($data['sort'])) {
            $UploadsClassify->sort = $data['sort'];
        }
        if ($UploadsClassify->save()) {
            return $this->success('创建成功');
        } else {
            return $this->fail('创建失败');
        }
    }
    public function deleteClassify(Request $request)
    {
        $dir_name = $request->post('dir_name');
        if (empty($dir_name)) {
            return $this->fail('目录名不能为空');
        }
        if ($dir_name == 'all') {
            return $this->fail('全部目录不能删除');
        }
        $UploadsClassify = UploadsClassify::where('dir_name', $dir_name)->find();
        if (!$UploadsClassify) {
            return $this->fail('目录不存在');
        }
        if ($UploadsClassify->is_system) {
            return $this->fail('系统分类，无法删除');
        }
        if (ModelUploads::where(['classify_id' => $UploadsClassify->id])->count() > 0) {
            return $this->fail('目录分类下有文件不能删除');
        }
        if ($UploadsClassify->delete()) {
            return $this->success('删除成功');
        } else {
            return $this->fail('删除失败');
        }
    }
}
