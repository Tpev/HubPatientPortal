<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FormInstance extends Model
{
    use HasFactory;

    protected $fillable = ['form_template_id', 'uuid'];

    // Ensure UUID is generated automatically if not provided
    protected static function booted()
    {
        static::creating(function ($formInstance) {
            $formInstance->uuid = Str::uuid();
        });
    }

    // Relationship with form template
    public function formTemplate()
    {
        return $this->belongsTo(FormTemplate::class);
    }

    // Relationship with form submissions (if necessary)
    public function submissions()
    {
        return $this->hasMany(FormSubmission::class);
    }
}
