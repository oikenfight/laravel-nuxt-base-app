<?php

namespace App\Entities;

use App\Entities\Contracts\EntityInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Entity
 *
 * @package App\Entities
 */
abstract class Entity extends Model implements EntityInterface
{
  use SoftDeletes;
}
