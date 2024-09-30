<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelCompanies extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'companies';
    public $incrementing = true;
    
    protected $fillable = [
        'name'
    ];

    public function taksMuch(): HasMany {
        return $this->hasMany( ModelTask::class, 'company_id');
    }
}
