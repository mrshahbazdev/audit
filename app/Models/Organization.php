<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'allocore_api_key',
    ];

    protected function casts(): array
    {
        return [
            'allocore_enabled' => 'boolean',
            'allocore_last_synced_at' => 'datetime',
        ];
    }

    /**
     * Whether this organization has a usable AlloCore Hub connection.
     */
    public function allocoreConnected(): bool
    {
        return $this->allocore_enabled
            && filled($this->allocore_hub_url)
            && filled($this->allocore_api_key);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function audits()
    {
        return $this->hasMany(Audit::class);
    }
}
