<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Traits\Empresa;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;

class LocacaoTalhao extends Model
{
    use HasFactory, SoftDeletes;

    use LogsActivity;
    use Uuid;
    use Empresa;
    use CrudTrait;


    // Gravação do Log
    protected static $logName = 'LocacaoTalhao'; // Nome do Log
    protected static $logAttributes = ['*']; // Pega todos os campos da entidade
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    // Define o nome da tabela
    protected $table = 'locacao_talhaos';

    // Chave Primaria
    protected $primaryKey = 'id';


    //Define os campos da entidade
    protected $fillable = [
        'tenant_id',
        'safra_id',
        'cultura_id',
        'variedade_cultura_id',
        'talhao_id',
        'area_plantada',
        'semente_linear',
        'semente_populacao',
        'inicio_plantio',
        'final_plantio',
        'data_prevista',
        'observacoes',
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
        'variedade_cultura_id' => 'integer',
        'talhao_id' => 'integer',
        'area_plantada' => 'double',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'inicio_plantio',
        'final_plantio',
        'data_prevista',
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
     * Método safra()
     * Responsavel por interligar as Entidades LocacaoTalhao com Safra
     * Traz as informações da Safra
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function safra()
    {
        return $this->belongsTo(Safra::class);
    }

    /**
     * Método cultura()
     * Responsavel por interligar as Entidades VariedadesCultura com Cutlura
     * Traz as informações da Cultura
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cultura()
    {
        return $this->belongsTo(Cultura::class);
    }

    /**
     * Método variedadeCultura()
     * Responsavel por interligar as Entidades LocacaoTalhao com VariedadeCultura
     * Traz as informações da VariedadeCultura
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function variedadeCultura()
    {
        return $this->belongsTo(VariedadeCultura::class);
    }

    /**
     * Método talhao()
     * Responsavel por interligar as Entidades LocacaoTalhao com Talhao
     * Traz as informações da Talhao
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function talhao()
    {
        return $this->belongsTo(Talhao::class);
    }
}
