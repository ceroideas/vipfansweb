<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MagnetismPackage extends Model
{
    public function getTable(){
   		return 'magnetism_packages';
   	}

   	public function getLang($iso , $item){
   		return Translation::where([
   			'iso_language' => $iso,
   			'table'        => $this->getTable(),
   			'key'          => $item,
   			'item_id'      => $this->id
   		])->first();
   	}
}
