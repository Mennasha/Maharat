<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class NationalityPrice extends Model {
    protected $fillable = ['nationality','price','notes','is_active'];
    protected $casts = ['is_active' => 'boolean'];
}
