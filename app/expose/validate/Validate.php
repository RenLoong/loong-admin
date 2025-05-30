<?php

namespace app\expose\validate;

use think\facade\Db;
use think\Validate as ThinkValidate;

class Validate extends ThinkValidate
{
    protected $failException = true;
    protected $db;
    /**
     * 设置Db对象
     * @access public
     * @param Db $db Db对象
     * @return void
     */
    public function setDb($db)
    {
        $this->db = $db;
    }
    public function unique($value, $rule, array $data = [], string $field = ''): bool
    {
        if (is_string($rule)) {
            $rule = explode(',', $rule);
        }

        $this->setDb(new Db);    //设置Db对象
        if (false !== strpos($rule[0], '\\')) {
            // 指定模型类
            $db = new $rule[0];
        } else {
            $db = $this->db::name($rule[0]);
        }
        $map = [];
        if (isset($data[$field])) {
            $map[] = [$field, '=', $data[$field]];
        }
        if (!empty($rule[1]) && strpos($rule[1], '^')) {
            // 支持多个字段验证
            $fields = explode('^', $rule[1]);
            foreach ($fields as $key) {
                if (isset($data[$key])) {
                    $map[] = [$key, '=', $data[$key]];
                }
            }
        }

        $pk = !empty($rule[3]) ? $rule[3] : $db->getPk();
        if (is_string($pk)) {
            if (isset($rule[2])) {
                $map[] = [$pk, '<>', $rule[2]];
            } elseif (isset($data[$pk])) {
                $map[] = [$pk, '<>', $data[$pk]];
            }
        }

        if ($db->where($map)->field($pk)->count()) {
            return false;
        }

        return true;
    }
}
