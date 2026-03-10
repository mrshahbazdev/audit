<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function answers()
    {
        return $this->hasMany(AuditAnswer::class);
    }

    public function results()
    {
        return $this->hasMany(AuditResult::class);
    }

    public function template()
    {
        return $this->belongsTo(AuditTemplate::class, 'template_id');
    }
}
