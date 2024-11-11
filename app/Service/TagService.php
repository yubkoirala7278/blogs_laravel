<?php

namespace App\Service;

use App\Models\Tag;

class TagService{
    // ==========POST============
    public function addService($request){
       Tag::create($request);
    }
    // =========================

    // ==========UPDATE==========
    public function updateService($request,$tag){
       $tag->update($request);
    }
    // =========================

   //  ==========DELETE=======
   public function deleteService($tag){
      $tag->delete();
   }
   // =======================
}