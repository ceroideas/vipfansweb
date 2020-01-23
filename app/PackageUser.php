<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageUser extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function getMethod(){
    	if ($this->payment_method == 1) {
    		return 'Paypal';
    	}else{
    		return 'Transferencia';
    	}
    }
}
