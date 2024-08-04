<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'reports';

    public function treatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'treated_by', 'id');
    }
}
