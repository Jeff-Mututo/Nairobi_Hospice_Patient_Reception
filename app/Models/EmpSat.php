<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpSat extends Model
{
    use HasFactory;
    protected $table = 'employee_satisfaction';
    public $timestamps = false;
}
