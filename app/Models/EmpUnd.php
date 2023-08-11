<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpUnd extends Model
{
    use HasFactory;
    protected $table = 'employee_understanding';
    public $timestamps = false;
}
