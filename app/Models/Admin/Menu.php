<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    public function create($data){
        return DB::table($this->table)->insert($data);
    }

    public function getParent(){
        return DB::table($this->table)->where('parent_id', 0)->get();
    }

    public function getAll(){
        $data = DB::table($this->table)
        ->orderBy('id', 'asc')
        ->get();
        return $data;
    }

    public function getOne($id){
        return DB::table($this->table)->where('id', $id)->get()->first();
    }

    public function delete($id=0){
        return DB::table($this->table)->where('id', $id)->delete();
    }
}
