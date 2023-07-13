<?php

namespace App\Models\Lancamentos;

use App\Models\Cultura;
use App\Models\GrupoProduto;
use App\Models\Produto;
use App\Models\Safra;
use App\Models\SubGrupoProduto;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Uuid;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Traits\Empresa;
use \Backpack\CRUD\app\Models\Traits\CrudTrait;

class Semente extends Model
{
    use HasFactory, SoftDeletes;

    use LogsActivity;
    use Uuid;
    use Empresa;
    use CrudTrait;

     // Gravação do Log
   protected static $logName = 'Semente'; // Nome do Log
   protected static $logAttributes = ['*']; // Pega todos os campos da entidade
   protected static $logOnlyDirty = true;
   protected static $submitEmptyLogs = false;

   // Define o nome da tabela
   protected $table = 'sementes';

   // Chave Primaria
   protected $primaryKey = 'id';

   
   //Define os campos da entidade
   protected $fillable = [
        'tenant_id',
        'nota_semente_id',
        'safra_id',
        'grupo_produto_id',
        'sub_grupo_produto_id',
        'produto_id',
        'cultura_id',
        'uuid',
        'lote',
        'peneira',
        'quantidade_embalagem',
        'peso_embalagem',
        'quantidade_semente',
        'pms',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tenant_id' => 'integer',
        'nota_semente_id' => 'integer',
        'safra_id' => 'integer',
        'grupo_produto_id' => 'integer',
        'sub_grupo_produto_id' => 'integer',
        'produto_id' => 'integer',
        'cultura_id' => 'integer',
        'quantidade_embalagem' => 'double',
        'peso_embalagem' => 'double',
        'quantidade_semente' => 'double',
        'pms' => 'double',
    ];


    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function notaSemente()
    {
        return $this->belongsTo(NotaSemente::class);
    }

    public function safra()
    {
        return $this->belongsTo(Safra::class);
    }

    public function grupoProduto()
    {
        return $this->belongsTo(GrupoProduto::class);
    }

    public function subGrupoProduto()
    {
        return $this->belongsTo(SubGrupoProduto::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function cultura()
    {
        return $this->belongsTo(Cultura::class);
    }
}
