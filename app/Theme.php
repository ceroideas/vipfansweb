<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    public function getTable(){
   		return 'themes';
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
