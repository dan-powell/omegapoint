<?php

namespace App\Models\Area;

use Illuminate\Database\Eloquent\Model;

class PointOfInterest extends Model
{

    protected $table = 'area_poi';

    protected $fillable = [
        'name'
    ];

    public function districts()
    {
        return $this->belongsToMany(District::class, 'area_district_poi', 'poi_id', 'district_id');
    }
}
