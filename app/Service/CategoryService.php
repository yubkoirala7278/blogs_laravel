<?php

namespace App\Service;

use App\Models\Category;

class CategoryService{

    // ========POST========
    public function addService($request){
       Category::create($request);
    }

    // =======DELETE==========
    public function delete($category){
        $category->delete();
    }

    // =======UPDATE===========
    public function updateService($request,$category){
        $category->update($request);
    }
}