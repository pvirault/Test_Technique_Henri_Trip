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
        'guide_id', // Assuming an activity is linked to a specific guide
    ];

    /**
     * Get the guide that owns the activity.
     */
    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }

}
