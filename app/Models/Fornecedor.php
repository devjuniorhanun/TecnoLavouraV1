<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Traits\Empresa;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;

class Fornecedor extends Model
{
    use HasFactory, SoftDeletes;

    use HasFactory, SoftDeletes;

    use LogsActivity;
    use Uuid;
    use Empresa;
    use CrudTrait;


    // Gravação do Log
    protected static $logName = 'Fornecedor'; // Nome do Log
    protected static $logAttributes = ['*']; // Pega todos os campos da entidade
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    // Define o nome da tabela
    protected $table = 'fornecedors';

    // Chave Primaria
    protected $primaryKey = 'id';


    //Define os campos da entidade
    protected $fillable = [
        'tenant_id',
        'uuid',
        'razao_social',
        'nome_fantasia',
        'cpf_cnpj',
        'rg_inscricao',
        'finalidade',
        'tipo',
        'email',
        'telefone',
        'celular',
        'cep',
        'estado',
        'cidade',
        'bairro',
        'endereco',
        'complmento',
        'numero',
        'nome_contato',
        'email_contato',
        'telefone_contato',
        'status',
        'nome_banco',
        'banco',
        'agencia',
        'num_conta',
        'operacao',
        'pix',
        'tipo_conta'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tenant_id' => 'integer',
    ];

    // Define os Relacionamentos
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

    public function motoristas()
    {
        return $this->belongsTo(Motorista::class);
    }

    
}
