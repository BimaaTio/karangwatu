<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function acara()
    {
        return $this->hasMany(Event::class);
    }
}
