<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $table = 'ticket_bus_brand';
    protected $primaryKey = 'id';
    
    use HasFactory;
}
