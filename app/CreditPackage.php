<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Translation;

class CreditPackage extends Model
{
   	public function getTable(){
   		return 'credit_packages';
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
