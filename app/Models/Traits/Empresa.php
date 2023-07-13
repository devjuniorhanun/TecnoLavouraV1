<?php
/**
 * Trait Uuid
 * Responsavel por gerar o tenant_id, na criação.
 * 
 */
namespace App\Models\Traits;
use App\Models\Tenant;

trait Empresa
{
    public static function bootEmpresa()
    {
        static::creating(function ($model) {
            $model->tenant_id = Tenant::first()->id;
        });
    }
}