<?php

namespace app\expose\build\utils;

use app\expose\utils\DataModel;

class TreeModel extends DataModel
{
    private function _organizeRecords($regions,$idKey)
    {
        $organizedRegions = [];
        foreach ($regions as $region) {
            $organizedRegions[$region[$idKey]] = $region;
            $organizedRegions[$region[$idKey]]['children'] = [];
        }
        return $organizedRegions;
    }
    private function _buildTree($organized,$pidKey)
    {
        $tree = [];
        foreach ($organized as $id => $record) {
            if ($record[$pidKey]) {
                $organized[$record[$pidKey]]['children'][] = &$organized[$id];
            } else {
                $tree[] = &$organized[$id];
            }
        }
        return $tree;
    }
    public function toTree($idKey='id',$pidKey='pid')
    {
        $organized=$this->_organizeRecords($this->data,$idKey);
        $data=$this->_buildTree($organized,$pidKey);
        return $data;
    }
}