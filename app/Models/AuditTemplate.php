<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditTemplate extends Model
{
    protected $guarded = [];

    public function pillars()
    {
        return $this->hasMany(AuditPillar::class, 'template_id')->orderBy('order');
    }

    public function questions()
    {
        return $this->hasMany(AuditQuestion::class, 'template_id');
    }

    public function audits()
    {
        return $this->hasMany(Audit::class, 'template_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
