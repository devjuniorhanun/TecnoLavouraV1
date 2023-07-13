<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Traits\Empresa;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;

class LancamentoContaApagar extends Model
{
    use HasFactory, SoftDeletes;

    use LogsActivity;
    use Uuid;
    use Empresa;
    use CrudTrait;

    // Gravação do Log
    protected static $logName = 'LancamentoContaApagar'; // Nome do Log
    protected static $logAttributes = ['*']; // Pega todos os campos da entidade
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    // Define o nome da tabela
    protected $table = 'lancamento_conta_apagars';

    // Chave Primaria
    protected $primaryKey = 'id';


    //Define os campos da entidade
    protected $fillable = [
        'tenant_id',
        'centro_custo_id',
        'fornecedor_id',
        'uuid',
        'numero_documento',
        'data_documento',
        'data_vencimento',
        'descricao',
        'valor',
        'valor_desconto',
        'tipo',
        'status',
        'produtor_id',
        'transferencia_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tenant_id' => 'integer',
        'centro_custo_id' => 'integer',
        'fornecedor_id' => 'integer',
        'valor' => 'double',
        'valor_desconto' => 'double',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'data_documento',
        'data_vencimento',
    ];


    /**
     * Método empresa()
     * Responsavel por interligar as Entidades Safras com Empresa
     * Traz as informações da Empresa
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empresa()
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Método centroCusto()
     * Responsavel por interligar as Entidades Safras com Empresa
     * Traz as informações da Empresa
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function centroCusto()
    {
        return $this->belongsTo(CentroCusto::class);
    }

    /**
     * Método fornecedor()
     * Responsavel por interligar as Entidades Safras com Empresa
     * Traz as informações da Empresa
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
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
