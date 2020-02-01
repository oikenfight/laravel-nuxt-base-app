<?php
declare(strict_types=1);

namespace App\Entities;

use App\Entities\Contracts\FolderInterface;
use App\Entities\Contracts\ItemInterface;
use App\Entities\Contracts\NoteInterface;
use App\Entities\Contracts\RackInterface;
use App\Entities\Contracts\UserInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


/**
 * User class
 */
class User extends Authenticatable implements UserInterface
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return RackInterface[]|\Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function racks()
    {
        // TODO: Implement racks() method.
    }

    /**
     * @return FolderInterface[]|\Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function folders()
    {
        // TODO: Implement folders() method.
    }

    /**
     * @return NoteInterface[]|\Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function notes()
    {
        // TODO: Implement notes() method.
    }

    /**
     * @return ItemInterface[]|\Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function items()
    {
        // TODO: Implement items() method.
    }
}
