<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FormTemplate extends Model
{
    protected $fillable = ['title', 'fields', 'user_id', 'uuid'];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function formInstances()
    {
        return $this->hasMany(FormInstance::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
	
	
}
