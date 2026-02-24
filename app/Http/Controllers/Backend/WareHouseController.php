<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\WareHouse;
use Illuminate\Http\Request;

class WareHouseController extends Controller
{
public function AllWarehouse()
    {
        $warehouse = WareHouse::latest()->get();
        return view("admin.backend.warehouse.all_warehouse", compact("warehouse"));
    }
    //End Method

    public function AddWarehouse()
    {
        return view("admin.backend.warehouse.add_warehouse");
    }
    //End Method
}
