<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug','label'
    ];


    protected $casts = [
        'id' => 'integer'
    ];

    public $must_notify_roles_names = [
        //'super_admin',
        'admin'
    ];


    public function scopeCollectRolesBySlug($query,$role_slug)
    {
        return $query->where([
            'slug' => $role_slug
        ])->get();
    }

    public static function getRoleBySlug($role_slug)
    {
        $roles = static::CollectRolesBySlug($role_slug);
        return $roles->count() > 0 ? $roles->first() : null;
    }

    /**
    * slug del super admin
    */
    private function getSuperAdminSlug()
    {
        return "super_admin";
    }

    public function isSuperAdmin()
    {
        return $this->getSuperAdminSlug() == $this->slug;
    }

    public function scopeCollectSuperAdminRoles($query)
    {
        return $query->where([
            'slug' => $this->getSuperAdminSlug()
        ])->get();
    }

    public function scopeCollectNotSuperAdminRoles($query)
    {
        return $query->where(
            'slug',"!=" ,$this->getSuperAdminSlug()
        )->get();
    }

    public static function getSuperAdmin()
    {
        $roles = static::CollectSuperAdminRoles();
        return $roles->count() > 0 ? $roles->first() : null;
    }

    /**
     * Trae los permisos del role
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Verifica que un role  tenga los permisos
     * @return boolean true en caso asignado , false en caso contrario
     */
    public function hasPermission($permission_slug)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        return $this->permissions()->CollectPermissionsBySlug($permission_slug)->count() > 0;
    }

    /**
     * Asigna un persmiso a un rol
     * @param  Permission $permission Objeto de tipo persmiso
     */
    public function givePermissionTo(Permission $permission)
    {
        if (!$this->hasPermission($permission->slug) ){
            return $this->permissions()->save($permission);
        }
        return true;
    }

    /**
     * trae los usuarios con este role
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     *  asigna el permiso a un usario
     * @param  User   $user usuario al que se le va asignar el permisio
     * @return [type]       [description]
     */
    public function assignTo(User $user)
    {
        if ( !$this->users()->find($user->id) ) {
            return $this->users()->save($user);
        }
        return true;
    }

}
