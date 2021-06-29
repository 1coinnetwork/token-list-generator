<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Network extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'networks';

    //protected $primaryKey = 'chainid';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'chainid',
        'name',
        'rpc_url',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function networkAssets()
    {
        return $this->hasMany(Asset::class, 'network_id', 'chainid');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
