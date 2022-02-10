<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'description'
    ];

    protected $dates = [
        'deleted_at'
    ];

    /**
     * Método de relacionamento entre a tabela subjects e a tabela categories
     */
    public function categories(){
        return $this->belongsTo(Category::class);
    }

    /**
     * Método de relacionamento entre a tabela subjects e a tabela users usando a tabela enrollments
     */
    public function enrollments(){
        return $this->belongsToMany(User::class)->using(Enrollment::class);
    }

}
