<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model {
    protected $fillable = ['name','nationality','age','religion','marital_status','language','height','weight','experience_years','previous_countries','skills','expected_salary','photo','passport_photo','intro_video','status','is_featured','notes'];
    protected $casts = ['previous_countries'=>'array','skills'=>'array','is_featured'=>'boolean'];

    public function orders() { return $this->hasMany(Order::class); }

    public function getStatusLabelAttribute() {
        return match($this->status) {
            'available' => 'متاح',
            'reserved' => 'محجوز',
            'unavailable' => 'غير متاح',
            default => $this->status
        };
    }
}
