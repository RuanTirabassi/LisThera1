<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyCheckin extends Model
{
    protected $table = 'dailycheckins';
    protected $primaryKey = 'dailycheckinid';
    public $timestamps = false;

    protected $fillable = [
        'therapistid',
        'horseid',
        'checkindate',
        'therapistnotes',
        'horsenotes',
        'usedsensor',
    ];

    public function therapist()
    {
        return $this->belongsTo(Therapist::class, 'therapistid', 'therapistid');
    }

    public function horse()
    {
        return $this->belongsTo(Horse::class, 'horseid', 'horseid');
    }
}
