<?php

namespace App\Models\Silo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Traits\Empresa;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;

class ContratoEmbarque extends Model
{
    use HasFactory, SoftDeletes;

    use LogsActivity;
    use Uuid;
    use Empresa;
    use CrudTrait;

     // Gravação do Log
   protected static $logName = 'ContratoEmbarque'; // Nome do Log
   protected static $logAttributes = ['*']; // Pega todos os campos da entidade
   protected static $logOnlyDirty = true;
   protected static $submitEmptyLogs = false;

   // Define o nome da tabela
   protected $table = 'contrato_embarques';

   // Chave Primaria
   protected $primaryKey = 'id';

   
   //Define os campos da entidade
   protected $fillable = [
        'tenant_id',
        'safra_id',
        'inscricao_estadual_id',
        'cultura_id',
        'fornecedor_id',
        'uuid',
        'num_contrato',
        'quantidade',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tenant_id' => 'integer',
        'safra_id' => 'integer',
        'inscricao_estadual_id' => 'integer',
        'cultura_id' => 'integer',
        'fornecedor_id' => 'integer',
        'quantidade' => 'double',
    ];


    public function tenant()
    {
        return $this->belongsTo(\App\Models\Tenant::class);
    }

    public function safra()
    {
        return $this->belongsTo(\App\Models\Safra::class);
    }

    public function inscricaoEstadual()
    {
        return $this->belongsTo(\App\Models\Silo\InscricaoEstadual::class);
    }

    public function cultura()
    {
        return $this->belongsTo(\App\Models\Cultura::class);
    }

    public function fornecedor()
    {
        return $this->belongsTo(\App\Models\Fornecedor::class);
    }
}
