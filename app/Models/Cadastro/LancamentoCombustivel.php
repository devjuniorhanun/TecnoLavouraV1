<?php

namespace App\Models\Cadastro;

use App\Models\Frota;
use App\Models\Produto;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Traits\Empresa;
use App\Models\User;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;

class LancamentoCombustivel extends Model
{
    
    use HasFactory, SoftDeletes;

    use LogsActivity;
    use Uuid;
    use Empresa;
    use CrudTrait;

    // Gravação do Log
    protected static $logName = 'LancamentoCombustivel'; // Nome do Log
    protected static $logAttributes = ['*']; // Pega todos os campos da entidade
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    // Define o nome da tabela
    protected $table = 'lancamento_combustivels';

    // Chave Primaria
    protected $primaryKey = 'id';


    //Define os campos da entidade
    protected $fillable = [
        'tenant_id',
        'user_id',
        'posto_combustivel_id',
        'frota_id',
        'produto_id',
        'uuid',
        'quantidade',
        'horimetro',
        'romaneio',
        'produtividade',
        'data_abastecimento',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tenant_id' => 'integer',
        'user_id' => 'integer',
        'posto_combustivel_id' => 'integer',
        'frota_id' => 'integer',
        'produto_id' => 'integer',
        'quantidade' => 'double',
        'produtividade' => 'double',
        'data_abastecimento' => 'date',
    ];


    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function postoCombustivel()
    {
        return $this->belongsTo(PostoCombustivel::class);
    }

    public function frota()
    {
        return $this->belongsTo(Frota::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
