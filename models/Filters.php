<?php

namespace models;

class Filters
{
    public function GetFilteredProducts($filters)
    {
        if (empty($filters))
            return null;
        else {
            $strWhere = [];
            $strOrder = [];
            $sizeWhere = [];
            $strSearch = '';
            if (isset($filters['ot']) && isset($filters['do'])) {
                $ot = $filters['ot'];
                $do = $filters['do'];
                $priceWhere = "price BETWEEN $ot AND $do";
            }
            if (empty($filters['ot']) && isset($filters['do'])) {
                $ot = 0;
                $do = $filters['do'];
                $priceWhere = "price BETWEEN $ot AND $do";
            }
            if (isset($filters['ot']) && empty($filters['do'])) {
                $ot = $filters['ot'];
                $do = 1000000;
                $priceWhere = "price BETWEEN $ot AND $do";
            }
            if (empty($filters['ot']) && empty($filters['do'])) {
                $priceWhere = "price BETWEEN 0 AND 10000000";
            }
            if (isset($filters['size'])) {
                foreach ($filters['size'] as $key => $filter)
                    $filters['size'][$key] = '%' . $filter . '%';
                $sizes = $filters['size'];
                foreach ($sizes as $size)
                    $sizeWhere [] = "size LIKE ('" . $size . "')";
                $sizeWhere = implode(' OR ', $sizeWhere);
            }
            if (isset($filters['kind'])) {
                $kind = implode("','", $filters['kind']);
                $strWhere [] = "kind in ('" . $kind . "')";
            }
            if (isset($filters['gender'])) {
                $gender = implode("','", $filters['gender']);
                $strWhere [] = "gender in ('" . $gender . "')";
            }
            if (!empty($filters['search']))
                $strSearch = "title LIKE '%{$filters['search']}%' COLLATE utf8_general_ci";
            if (!empty($strWhere))
                $strWhere = implode(' AND ', $strWhere);
            if (!empty($strWhere) && empty($strSearch))
                $strWhere = $priceWhere . " AND " . $strWhere;
            if (empty($strWhere) && empty($strSearch))
                $strWhere = $priceWhere;
            if (empty($strWhere) && !empty($strSearch))
                $strWhere = $priceWhere . " AND " . $strSearch;
            if (!empty($strWhere) && !empty($strSearch))
                $strWhere = $strWhere . " AND " . $priceWhere . " AND " . $strSearch;
            if (!empty($filters['sort'])) {
                if ($filters['sort'] != 'min_price' && $filters['sort'] != 'max_price')
                    $strOrder = ['datetime' => 'DESC'];
                if ($filters['sort'] == 'min_price')
                    $strOrder = ['price' => 'ASC'];
                if ($filters['sort'] == 'max_price')
                    $strOrder = ['price' => 'DESC'];
            }
            if (!empty($sizeWhere))
                $strWhere = $strWhere . " AND " . $sizeWhere;
            return \core\Core::getInstance()->getDB()->select('products', '*', $strWhere, $strOrder);
        }
    }
}