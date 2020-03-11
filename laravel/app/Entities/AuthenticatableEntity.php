<?php
declare(strict_types=1);

namespace App\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class AuthenticatableEntity
 *
 * @package App\Entities
 */
abstract class AuthenticatableEntity extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 50;
}
