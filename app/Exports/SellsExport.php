<?php

namespace App\Exports;

use App\PackageUser;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SellsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $sells;
    
    public function __construct($data = null){
        $this->sells = $data;
    }

    public function array(): array{
        return $this->sells;
    }

     public function view(): View{
        return view('admin.exportSells', [
            'data' => $this->sells
        ]);
    }
}
