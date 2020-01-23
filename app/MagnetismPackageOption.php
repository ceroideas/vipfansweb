<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MagnetismPackageOption extends Model
{
    public function getTable(){
   		return 'magnetism_package_options';
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
