<?php

namespace CMS\InwentLegal\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InwentLegal extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','effective_date','summary_of_changes','description'];
    protected $table='inwent_legal';
    protected static function newFactory()
    {
        return \CMS\InwentLegal\Database\factories\InwentLegalFactory::new();
    }
}
