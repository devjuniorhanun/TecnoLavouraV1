<?php

namespace App\Models\Lancamentos;

use App\Models\Produtor;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Traits\Empresa;
use App\Models\User;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;

class ChequeEmitido extends Model
{
    use HasFactory, SoftDeletes;

    use LogsActivity;
    use Uuid;
    use Empresa;
    use CrudTrait;

     // Gravação do Log
   protected static $logName = 'ChequeEmitido'; // Nome do Log
   protected static $logAttributes = ['*']; // Pega todos os campos da entidade
   protected static $logOnlyDirty = true;
   protected static $submitEmptyLogs = false;

   // Define o nome da tabela
   protected $table = 'cheque_emitidos';

   // Chave Primaria
   protected $primaryKey = 'id';

   
   //Define os campos da entidade
   protected $fillable = [
        'tenant_id',
        'produtor_id',
        'uuid',
        'data_lancamento',
        'descricao_lancamento',
        'valor_lancamento',
        'para_quem',
        'nome_banco',
        'agencia',
        'num_conta',
        'num_cheque',
    ];

    

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function produtor()
    {
        return $this->belongsTo(Produtor::class);
    }
}
