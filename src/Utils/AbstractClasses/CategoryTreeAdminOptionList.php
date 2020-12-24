<?php

namespace App\Utils\AbstractClasses;

class CategoryTreeAdminOptionList extends CategoryTreeAbstract {

    public function getCategoryList(array $categories_array, int $repeat = 0)
    {
        foreach ($categories_array as $value)
        {
            $this->categorylist[] = ['name'=>str_repeat("-", $repeat).$value
            ['name'], 'id'=>$value['id']];

            if (!empty($value['children']))
            {
                $repeat += 2;
                $this->getCategoryList($value['children'], $repeat);
                $repeat -= 2;
            }
        }
        return $this->categorylist;
    }
}