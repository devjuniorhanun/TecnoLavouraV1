<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Traits\Empresa;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;

class GrupoProduto extends Model
{
    use HasFactory, SoftDeletes;

    use LogsActivity;
    use Uuid;
    use Empresa;
    use CrudTrait;


    // Gravação do Log
    protected static $logName = 'GrupoProduto'; // Nome do Log
    protected static $logAttributes = ['*']; // Pega todos os campos da entidade
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    // Define o nome da tabela
    protected $table = 'grupo_produtos';

    // Chave Primaria
    protected $primaryKey = 'id';


    //Define os campos da entidade
    protected $fillable = [
        'tenant_id',
        'uuid',
        'nome',
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
     * Método subGrupoProdutos()
     * Responsavel por interligar as Entidades Safras com subGrupoProdutos
     * Traz as informações da subGrupoProdutos
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function subGrupoProdutos()
    {
        return $this->hasMany(SubGrupoProduto::class);
    }

    /**
     * Método produtos()
     * Responsavel por interligar as Entidades Safras com Produto
     * Traz as informações da Produto
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

}
