<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Student extends Model
{
    use HasFactory;
    use Searchable;
    
    
    protected $fillable = [
        'name',
        'last_name',
        'dni',
        'birthday',
        'year',
        'grade',
        'status'
    ];

        public function assists()
        {
            return $this->hasMany(Assist::class);
        }


    public function toSearchableArray()
    {
        return[
            'dni' => $this->dni,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'id' => $this->id,
            'grade' => $this->year,
            'status' => $this->status,
        ];
    }
}

