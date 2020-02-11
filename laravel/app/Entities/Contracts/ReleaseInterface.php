<?php
declare(strict_types=1);

namespace App\Entities\Contracts;

/**
 * Interface ReleaseInterface
 * @package App\Entities\Contracts
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Release newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Release newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Release query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Release whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Release whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Release whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Release whereUpdatedAt($value)
 * @mixin \Eloquent
 */
interface ReleaseInterface extends EntityInterface
{
  //
}
