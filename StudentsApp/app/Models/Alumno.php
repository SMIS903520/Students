<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'alumnos';

    protected $fillable = ['code','name','address','mobile','email'];
	
}
