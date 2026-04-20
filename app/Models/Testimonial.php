<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model {
    protected $fillable = ['client_name','content','rating','photo','is_active'];
    protected $casts = ['is_active' => 'boolean'];
}
