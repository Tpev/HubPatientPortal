<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    protected $fillable = ['form_instance_id', 'data'];

    public function formInstance()
    {
        return $this->belongsTo(FormInstance::class);
    }
}
