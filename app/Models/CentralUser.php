<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Contracts\SyncMaster;
use Stancl\Tenancy\Database\Concerns\ResourceSyncing;
use Stancl\Tenancy\Database\Concerns\CentralConnection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Stancl\Tenancy\Database\Models\TenantPivot;
use Spatie\Permission\Traits\HasRoles;


class CentralUser extends Model implements SyncMaster
{
    // Note that we force the central connection on this model
    use ResourceSyncing, CentralConnection;
    use HasRoles;

//    protected $guarded = [];
    protected $guard_name = 'web';

    public $timestamps = false;
    public $table = 'users';

    protected $fillable = [
        'global_id',
        'first_name',
        'phone',
        'last_name',
        'email',
        'password',
        'remember_token',
        'two_fact_auth',
    ];


    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(Tenant::class, 'tenant_users', 'global_user_id', 'tenant_id', 'global_id')
            ->using(TenantPivot::class);
    }

    public function getTenantModelName(): string
    {
        return User::class;
    }

    public function getGlobalIdentifierKey()
    {
        return $this->getAttribute($this->getGlobalIdentifierKeyName());
    }

    public function getGlobalIdentifierKeyName(): string
    {
        return 'global_id';
    }

    public function getCentralModelName(): string
    {
        return static::class;
    }

    public function getSyncedAttributeNames(): array
    {
        return [
            'global_id',
            'first_name',
            'last_name',
            'phone',
            'password',
            'email',
            'remember_token',
            'two_fact_auth',
        ];
    }
}