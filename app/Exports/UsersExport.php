<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $users;
    
    public function __construct($data = null){
        $this->users = $data;
    }

    public function array(): array{
        return $this->users;
    }

     public function view(): View{
        return view('admin.exportUsers', [
            'data' => $this->users
        ]);
    }
}
