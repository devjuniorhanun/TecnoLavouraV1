<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Traits\Empresa;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Support\Facades\DB;

class AdiantamentoColhedo extends Model
{
    use HasFactory, SoftDeletes;

    use LogsActivity;
    use Uuid;
    use Empresa;
    use CrudTrait;

     // Gravação do Log
   protected static $logName = 'AdiantamentoColhedo'; // Nome do Log
   protected static $logAttributes = ['*']; // Pega todos os campos da entidade
   protected static $logOnlyDirty = true;
   protected static $submitEmptyLogs = false;

   // Define o nome da tabela
   protected $table = 'adiantamento_colhedos';

   // Chave Primaria
   protected $primaryKey = 'id';

   
   //Define os campos da entidade
   protected $fillable = [
        'tenant_id',
        'safra_id',
        'fornecedor_id',
        'produtor_id',
        'uuid',
        'data_pagamento',
        'valor_pagamento',
        'tipo_adiantamento',
        'nome_fornecedor',
        'cpf_cnpj',
        'nome_banco',
        'agencia',
        'num_conta',
        'num_cheque',
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
        'fornecedor_id' => 'integer',
        'data_pagamento' => 'date',
        'valor_pagamento' => 'double',
    ];


    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function safra()
    {
        return $this->belongsTo(Safra::class);
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    public function scopeListaColhedores()
    {
         $result = DB::table('fornecedors')->where('fornecedors.finalidade', '=', 'COLHEDOR')
            ->join('lancamento_safras', 'lancamento_safras.colhedor_fornecedor_id', '=', 'fornecedors.id')
            ->join('safras', 'safras.id', '=', 'lancamento_safras.safra_id')
            ->leftJoin('adiantamento_colhedos', 'adiantamento_colhedos.fornecedor_id', '=', 'fornecedors.id')
            ->select('fornecedors.*')
            ->where('safras.status', '=', 'Ativa')
            ->orderBy('fornecedors.razao_social')
            ->groupBy('lancamento_safras.colhedor_fornecedor_id')
            ->paginate(1000000);
        return $result;
    }

    /**
     * Método produtor()
     * Responsavel por interligar as Entidades Fazenda com Produtor
     * Traz as informações do Produtor.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function produtor()
    {
        return $this->belongsTo(Produtor::class);
    }
}
