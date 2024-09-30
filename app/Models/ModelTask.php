<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelTask  extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'task';
    public $incrementing = true;
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'name',
        'company_id',
        'user_id',
        'description',
        'is_completed',
        'start_at',
        'expired_at'
    ];
    

    /**
     * Relación con la empresa (muchas tareas pertenecen a una empresa)
     */
    public function companyBelong(): BelongsTo {
        return $this->belongsTo(ModelCompanies::class, 'company_id');
    }

    /**
     * Relación con el usuario (muchas tareas pertenecen a un usuario)
     */
    public function userBelong(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
   
}
