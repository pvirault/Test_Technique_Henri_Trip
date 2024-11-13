<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
     protected $fillable = [
        'title',
        'description',
        'category',
        'address',
        'phone_number',
        'opening_hours',
        'website',
        'visit_order',
        'guide_id', // The guide associated with this activity
    ];

    /**
     * Define relationship: an activity belongs to a guide
     */
    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }

}
