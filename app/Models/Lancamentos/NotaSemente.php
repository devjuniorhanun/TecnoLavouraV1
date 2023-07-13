<?php

namespace App\Models\Lancamentos;

use App\Models\Fornecedor;
use App\Models\Produtor;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Traits\Empresa;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;

class NotaSemente extends Model
{
    use HasFactory, SoftDeletes;

    use LogsActivity;
    use Uuid;
    use Empresa;
    use CrudTrait;

     // Gravação do Log
   protected static $logName = 'NotaSemente'; // Nome do Log
   protected static $logAttributes = ['*']; // Pega todos os campos da entidade
   protected static $logOnlyDirty = true;
   protected static $submitEmptyLogs = false;

   // Define o nome da tabela
   protected $table = 'nota_sementes';

   // Chave Primaria
   protected $primaryKey = 'id';

   
   //Define os campos da entidade
   protected $fillable = [
        'tenant_id',
        'produtor_id',
        'fornecedor_id',
        'uuid',
        'nota_fiscal',
        'data_emissao',
        'data_chegada',
        'transportadora',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tenant_id' => 'integer',
        'produtor_id' => 'integer',
        'fornecedor_id' => 'integer',
        'data_emissao' => 'date',
        'data_chegada' => 'date',
    ];


    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function produtor()
    {
        return $this->belongsTo(Produtor::class);
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }
}
