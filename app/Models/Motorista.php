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

class Motorista extends Model
{
    use HasFactory, SoftDeletes;

    use Uuid;
    use Empresa;
    use CrudTrait;

    // Gravação do Log
    protected static $logName = 'Motorista'; // Nome do Log
    protected static $logAttributes = ['*']; // Pega todos os campos da entidade
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    // Define o nome da tabela
    protected $table = 'motoristas';

    // Chave Primaria
    protected $primaryKey = 'id';


    //Define os campos da entidade
    protected $fillable = [
        'tenant_id',
        'fornecedor_id',
        'uuid',
        'nome',
        'cpf',
        'placa',
        'tipo',
        'celular',
        'placa_nome',
        'cep',
        'estado',
        'cidade',
        'bairro',
        'endereco',
        'complemento',
        'numero',
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
        'fornecedor_id' => 'integer',
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
     * Método fornecedor()
     * Responsavel por interligar as Entidades Safras com Empresa
     * Traz as informações da Empresa
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    public function scopeListaMotoristas($query,$id)
    {
        //dd($id);
        $result = DB::table('safras')->where('safras.status', '=', 'Ativa')
        ->where('lancamento_safras.id', '>', 0)
        ->leftJoin('lancamento_safras', 'lancamento_safras.safra_id', '=', 'safras.id')
        ->leftJoin('motoristas', 'motoristas.id', '=', 'lancamento_safras.motorista_id')
        ->where('motorista_fornecedor_id', '=', $id)
        //->select
        ->groupBy('lancamento_safras.motorista_id')
        ->get()
        ;
        return $result;

    }
}
