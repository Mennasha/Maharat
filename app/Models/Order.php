<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    protected $fillable = ['client_id','worker_id','status','notes','contract_pdf','visa_image','ticket_image','total_amount','paid_amount'];

    public function client() { return $this->belongsTo(Client::class); }
    public function worker() { return $this->belongsTo(Worker::class); }
    public function timeline() { return $this->hasMany(OrderTimeline::class)->orderBy('created_at','desc'); }

    public function getStatusLabelAttribute() {
        return match($this->status) {
            'contracted' => 'تم التعاقد',
            'visa_processing' => 'قيد استخراج التأشيرة',
            'training' => 'قيد التدريب',
            'ticket_booked' => 'تم حجز التذكرة',
            'arrived' => 'وصل',
            default => $this->status
        };
    }
}
