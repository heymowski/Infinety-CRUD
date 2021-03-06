<?php

namespace __storagePath____Singular__\Models;

use Illuminate\Database\Eloquent\Model;

use Infinety\CRUD\CrudTrait;

use Vinkla\Translator\IsTranslatable;

use Vinkla\Translator\Translatable;

class __Singular__ extends Model implements IsTranslatable
{
    use CrudTrait;

    use Translatable;

    protected $table = '__plural__';

    protected $fillable = [ __model_fillable__ ];

    protected $translatedAttributes = [ __model_translatable_fillable__ ];

     /**
     * Get the translations relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations()
    {
        return $this->hasMany(\__storagePath____Singular__\Models\__Singular__Translation::class, '__plural___id', 'id');
    }
}
