<?php

namespace App\Models\Lancamentos;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Traits\Empresa;
use App\Models\User;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;

class Caixa extends Model
{
    use HasFactory, SoftDeletes;

    use LogsActivity;
    use Uuid;
    use Empresa;
    use CrudTrait;

     // Gravação do Log
   protected static $logName = 'Caixa'; // Nome do Log
   protected static $logAttributes = ['*']; // Pega todos os campos da entidade
   protected static $logOnlyDirty = true;
   protected static $submitEmptyLogs = false;

   // Define o nome da tabela
   protected $table = 'caixas';

   // Chave Primaria
   protected $primaryKey = 'id';

   
   //Define os campos da entidade
   protected $fillable = [
        'tenant_id',
        'controle_caixa_id',
        'centro_custo_id',
        'user_id',
        'data_lancamento',
        'descricao_lancamento',
        'tipo_pagamento',
        'pagamento_para',
        'valor_lancamento',
        'adiantamento',
    ];



    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function controleCaixa()
    {
        return $this->belongsTo(ControleCaixa::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Método centroCusto()
     * Responsavel por interligar as Entidades Safras com Empresa
     * Traz as informações da Empresa
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function centroCusto()
    {
        return $this->belongsTo(centroCusto::class);
    }
}
