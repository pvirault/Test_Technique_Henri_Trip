<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',          // The title of the guide
        'description',    // A description of the guide
        'days_count',     // Number of days for the guide
        'options',        // Options like mobility, season, target audience, etc.
    ];

    /**
     * Get the activities associated with the guide.
     */
    public function activities()
    {
        return $this->hasMany(Activity::class);  // A guide can have many activities
    }

     /**
     * Get the mobility option from the options JSON.
     *
     * @return string|null
     */
    public function getMobilityAttribute()
    {
        return $this->options['mobility'] ?? null;
    }

    /**
     * Get the season option from the options JSON.
     *
     * @return string|null
     */
    public function getSeasonAttribute()
    {
        return $this->options['season'] ?? null;
    }

    /**
     * Get the target audience option from the options JSON.
     *
     * @return string|null
     */
    public function getForWhomAttribute()
    {
        return $this->options['for_whom'] ?? null;
    }

}
