<?php

namespace App\Models\Cadastro;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Traits\Empresa;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;

class PostoTransferencia extends Model
{
    use HasFactory, SoftDeletes;
    use LogsActivity;
    use Uuid;
    use Empresa;
    use CrudTrait;


    // Gravação do Log
    protected static $logName = 'PostoTransferencia'; // Nome do Log
    protected static $logAttributes = ['*']; // Pega todos os campos da entidade
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    // Define o nome da tabela
    protected $table = 'posto_transferencias';

    // Chave Primaria
    protected $primaryKey = 'id';


    //Define os campos da entidade
    protected $fillable = [
        'tenant_id',
        'user_id',
        'posto_combustivel_id',
        'posto_segundario_id',
        'produto_id',
        'uuid',
        'qtn_estoque',
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
        'posto_segundario_id' => 'integer',
        'produto_id' => 'integer',
        'qtn_estoque' => 'double',
    ];


    public function tenant()
    {
        return $this->belongsTo(\App\Models\Tenant::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function postoCombustivel()
    {
        return $this->belongsTo(PostoCombustivel::class);
    }

    public function postoCombustivelCombio()
    {
        return $this->belongsTo(PostoCombustivel::class,'posto_segundario_id');
    }

    public function produto()
    {
        return $this->belongsTo(\App\Models\Produto::class);
    }
}
