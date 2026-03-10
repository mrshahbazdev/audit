<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditQuestion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function template()
    {
        return $this->belongsTo(AuditTemplate::class, 'template_id');
    }

    public function pillar()
    {
        return $this->belongsTo(AuditPillar::class, 'pillar_id');
    }
}
