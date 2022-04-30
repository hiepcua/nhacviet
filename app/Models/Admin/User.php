<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    use HasFactory;
    protected $table = 'users';

    public function addUser($data){
        return DB::table($this->table)->insert($data);
    }

    public function getUserByEmail($email=null){
        $data = DB::table($this->table)
        ->where('email', $email)
        ->get()->first();
        return $data;
    }

    public function updateUser($data, $email){
        return DB::table($this->table)->where('email', $email)->update($data);
    }
}
