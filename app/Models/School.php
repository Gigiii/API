<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $table = 'schools';
    protected $fillable = ['Name'];
    public function Fields(){
        return $this->hasMany(Field::class);
    }

    public function Students(){
        return $this->hasMany(Student::class);
    }

    public function Professor(){
        return $this->hasMany(Professor::class);
    }

}
