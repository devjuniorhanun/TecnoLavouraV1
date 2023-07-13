<?php

namespace App\Models\Silo;

use App\Models\Cultura;
use App\Models\Motorista;
use App\Models\Safra;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Traits\Empresa;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;

class SaidaSilo extends Model
{
    use CrudTrait;
    use HasFactory, SoftDeletes;
    use LogsActivity;
    use Uuid;
    use Empresa;


     // Gravação do Log
   protected static $logName = 'SaidaSilo'; // Nome do Log
   protected static $logAttributes = ['*']; // Pega todos os campos da entidade
   protected static $logOnlyDirty = true;
   protected static $submitEmptyLogs = false;

   // Define o nome da tabela
   protected $table = 'saida_silos';

   // Chave Primaria
   protected $primaryKey = 'id';

   
   //Define os campos da entidade
   protected $fillable = [
        'tenant_id',
        'safra_id',
        'cultura_id',
        'contrato_embarque_id',
        'contrato_inscricao_id',
        'motorista_id',
        'uuid',
        'primeira_pesagem',
        'segunda_pesagam',
        'umidade',
        'impuresa',
        'ardido',
        'partido',
        'avariado',
        'desconto',
        'peso_bruto',
        'peso_liquido',
        'saco_bruto',
        'saco_liquido',
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
        'cultura_id' => 'integer',
        'contrato_embarque_id' => 'integer',
        'contrato_inscricao_id' => 'integer',
        'motorista_id' => 'integer',
        'primeira_pesagem' => 'double',
        'segunda_pesagam' => 'double',
        'umidade' => 'double',
        'impuresa' => 'double',
        'ardido' => 'double',
        'partido' => 'double',
        'avariado' => 'double',
        'desconto' => 'double',
        'peso_bruto' => 'double',
        'peso_liquido' => 'double',
        'saco_bruto' => 'double',
        'saco_liquido' => 'double',
    ];


    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function safra()
    {
        return $this->belongsTo(Safra::class);
    }

    public function cultura()
    {
        return $this->belongsTo(Cultura::class);
    }

    public function contratoEmbarque()
    {
        return $this->belongsTo(ContratoEmbarque::class);
    }

    public function contratoInscricao()
    {
        return $this->belongsTo(ContratoInscricao::class);
    }

    public function motorista()
    {
        return $this->belongsTo(Motorista::class);
    }
}
