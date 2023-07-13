<?php

namespace App\Models\Lancamentos;

use App\Models\CentroCusto;
use App\Models\Fornecedor;
use App\Models\Produtor;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Traits\Empresa;
use App\Models\Traits\Usuario;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;

class Transferencia extends Model
{
    use HasFactory, SoftDeletes;

   use HasFactory, SoftDeletes;

    use LogsActivity;
    use Uuid;
    use Usuario;
    use Empresa;
    use CrudTrait;

     // Gravação do Log
   protected static $logName = 'Transferencia'; // Nome do Log
   protected static $logAttributes = ['*']; // Pega todos os campos da entidade
   protected static $logOnlyDirty = true;
   protected static $submitEmptyLogs = false;

   // Define o nome da tabela
   protected $table = 'transferencias';

   // Chave Primaria
   protected $primaryKey = 'id';

   
   //Define os campos da entidade
   protected $fillable = [
        'tenant_id',
        'user_id',
        'uuid',
        'data_lancamento',
        'fornecedores',
        'descricao_lancamento',
        'pix',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'fornecedores' => 'array',
    ];


    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    public function centroCusto()
    {
        return $this->belongsTo(CentroCusto::class);
    }

    public function produtores()
    {
        return $this->belongsTo(Produtor::class);
    }

    public function openOrdem($crud = false)
    {
        return "<a class='btn btn-sm btn-link' target='_blank' href='".route('transferencia', $this->id)."' data-toggle='tooltip' title='Transferência.: ".$this->id ."'><i class='la la-search'></i> Transferência.: ".$this->id ."</a>";
    }
}
