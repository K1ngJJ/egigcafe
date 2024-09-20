<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CateringOptions extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'description'];

//    public function packages()
//    {
//        return $this->belongsToMany(Package::class, 'service_group');
//    }

public function reservations()
{
    return $this->belongsTo(Reservation::class);
}
  
}
