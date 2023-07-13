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

class ServicoAgricola extends Model
{
    use HasFactory, SoftDeletes;

    use LogsActivity;
    use Uuid;
    use Empresa;
    use CrudTrait;

    // Gravação do Log
    protected static $logName = 'ServicoAgricola'; // Nome do Log
    protected static $logAttributes = ['*']; // Pega todos os campos da entidade
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    // Define o nome da tabela
    protected $table = 'servico_agricolas';

    // Chave Primaria
    protected $primaryKey = 'id';


    //Define os campos da entidade
    protected $fillable = [
        'tenant_id',
        'safra_id',
        'cultura_id',
        'talhao_id',
        'tipo_operacao_agricula_id',
        'uuid',
        'num_os',
        'data',
        'volume_bomba',
        'vazao',
        'capacidade_bomba',
        'bomba_recomendada',
        'bomba_usada',
        'diferenca_bomba',
        'fator_conversao',
        'area',
        'observacao',
        'status',
        'operadores',
        'produtos',
        'qtn_bomba',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'operadores' => 'array',
        'produtos' => 'array',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'data',
    ];


    public function operadorAgriculas()
    {
        return $this->belongsToMany(OperadorAgricula::class, 'operador_agricula_servico_agricola', 'servico_agricola_id', 'operador_agricula_id');
    }

    public function produtoss()
    {
        return $this->belongsToMany(Produto::class, 'produto_servico_agricola', 'servico_agricola_id', 'produto_id');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function safra()
    {
        return $this->belongsTo(Safra::class);
    }

    public function cultura()
    {
        return $this->belongsTo(Cultura::class);
    }

    public function talhao()
    {
        return $this->belongsTo(Talhao::class);
    }

    public function tipoOperacaoAgricula()
    {
        return $this->belongsTo(TipoOperacaoAgricula::class);
    }

    public function openOrdem($crud = false)
    {
        return "<a class='btn btn-sm btn-link' target='_blank' href='".route('servicos.ordem', $this->id)."' data-toggle='tooltip' title='Ordem.: ".$this->id ."'><i class='la la-search'></i> Ordem.: ".$this->num_os ."</a>";
    }

    public function openControle($crud = false)
    {
        return "<a class='btn btn-sm btn-link' target='_blank' href='".route('servicos.produtos', $this->id)."' data-toggle='tooltip' title='Controle.: ".$this->id ."'><i class='la la-search'></i> Controle.: ".$this->num_os ."</a>";
    }


    public function produto()
    {
        return DB::table('produto_servico_agricola')
                ->where('servico_agricola_id','=',$this->id)
                ->join('produtos', 'produtos.id', '=', 'produto_servico_agricola.produto_id')
                ->get();
    }

    

    public function operador()
    {
        return DB::table('operador_agricula_servico_agricola')
                ->where('servico_agricola_id','=',$this->id)
                ->join('operador_agriculas', 'operador_agriculas.id', '=', 'operador_agricula_servico_agricola.operador_agricula_id')
                ->get();
    }
}
