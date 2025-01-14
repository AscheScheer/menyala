<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    // Kolom yang diizinkan untuk mass assignment
    protected $fillable = ['class_name', 'teacher_id'];

    // Relasi ke model Teacher
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
