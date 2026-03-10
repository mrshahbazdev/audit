<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditPillar extends Model
{
    protected $guarded = [];

    public function template()
    {
        return $this->belongsTo(AuditTemplate::class, 'template_id');
    }

    public function questions()
    {
        return $this->hasMany(AuditQuestion::class, 'pillar_id');
    }
}
