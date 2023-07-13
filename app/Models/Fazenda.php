<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Traits\Empresa;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;

class Fazenda extends Model
{
    use HasFactory, SoftDeletes;

    use LogsActivity;
    use Uuid;
    use Empresa;
    use CrudTrait;


    // Gravação do Log
    protected static $logName = 'Fazendas'; // Nome do Log
    protected static $logAttributes = ['*']; // Pega todos os campos da entidade
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    // Define o nome da tabela
    protected $table = 'fazendas';

    // Chave Primaria
    protected $primaryKey = 'id';


    //Define os campos da entidade
    protected $fillable = [
        'tenant_id',
        'proprietario_id',
        'produtor_id',
        'uuid',
        'nome',
        'inscricao_estadual',
        'status',
        'area_total',
        'nome_gerente',
        'cep',
        'estado',
        'cidade',
        'bairro',
        'endereco',
        'complemento',
        'numero',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tenant_id' => 'integer',
        'proprietario_id' => 'integer',
        'produtor_id' => 'integer',
        'area_total' => 'double',
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

    /**
     * Método proprietario()
     * Responsavel por interligar as Entidades Fazenda com Proprietario
     * Traz as informações do proprietario.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function proprietario()
    {
        return $this->belongsTo(Proprietario::class);
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

    /**
     * Método talhaos()
     * Responsavel por interligar as Entidades Fazenda com Talhões
     * Traz as informações dos Talhões, refrente a uma fazenda específica.
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function talhaos()
    {
        return $this->hasMany(Talhao::class);
    }

    
}
