<?php
/**
 * Trait Uuid
 * Responsavel por gerar o tenant_id, na criação.
 * 
 */
namespace App\Models\Traits;


trait Usuario
{
    public static function bootUsuario()
    {
        static::creating(function ($model) {
            $model->user_id = backpack_user()->id;
            //dd($model);
            
        });
        
    }
}