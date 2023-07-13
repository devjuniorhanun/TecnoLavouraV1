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

class Colhedor extends Model
{
    use HasFactory, SoftDeletes;

    use LogsActivity;
    use Uuid;
    use Empresa;
    use CrudTrait;

    // Gravação do Log
    protected static $logName = 'Colhedor'; // Nome do Log
    protected static $logAttributes = ['*']; // Pega todos os campos da entidade
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    // Define o nome da tabela
    protected $table = 'colhedors';

    // Chave Primaria
    protected $primaryKey = 'id';


    //Define os campos da entidade
    protected $fillable = [
        'tenant_id',
        'fornecedor_id',
        'uuid',
        'nome',
        'qnt_linha',
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

    /*public function scopeListaColhedor()
    {
        $result = DB::table('fornecedors')->where('fornecedors.finalidade', '=', 'COLHEDOR')
            ->join('lancamento_safras', 'lancamento_safras.colhedor_fornecedor_id', '=', 'fornecedors.id')
            ->join('safras', 'safras.id', '=', 'lancamento_safras.safra_id')
            ->leftJoin('adiantamento_colhedos', 'adiantamento_colhedos.fornecedor_id', '=', 'fornecedors.id')
            ->select(
                'fornecedors.*',
                'lancamento_safras.colhedor_fornecedor_id',
                DB::raw('SUM(saco_bruto) as sacoBruto'),
                DB::raw('SUM(valor_frete) as frete'),
                DB::raw('count(lancamento_safras.id) as qtnViagem'),
                DB::raw('SUM(adiantamento_colhedos.valor_pagamento) as valorAdiantamento')
            )
            ->where('safras.status', '=', 'Ativa')
            ->groupBy('lancamento_safras.colhedor_fornecedor_id')
            ->get();
        return $result;
    }*/

    public function scopeListaColhedor()
    {
        $result = DB::table('fornecedors')->where('fornecedors.finalidade', '=', 'COLHEDOR')
            ->join('lancamento_safras', 'lancamento_safras.colhedor_fornecedor_id', '=', 'fornecedors.id')
            ->join('safras', 'safras.id', '=', 'lancamento_safras.safra_id')
            //
            ->addSelect([
                'valorAdiantamento' => AdiantamentoMotorista::whereColumn('fornecedor_id', '=', 'fornecedors.id')
                    ->select(DB::raw('SUM(valor_pagamento)'))->limit(1)
            ])
            ->addSelect([
                'sacoBruto' => LancamentoSafra::whereColumn('colhedor_fornecedor_id', '=', 'fornecedors.id')
                    ->select(DB::raw('SUM(saco_bruto)'))->limit(1)
            ])
            
            ->addSelect([
                'qtnViagem' => LancamentoSafra::whereColumn('colhedor_fornecedor_id', '=', 'fornecedors.id')
                    ->select(DB::raw('count(id)'))->limit(1)
            ])
            ->where('safras.status', '=', 'Ativa')
            ->groupBy('lancamento_safras.colhedor_fornecedor_id')
            ->orderBy('fornecedors.nome_fantasia')
            ->get();
        //dd($result);
        return $result;
    }
}
