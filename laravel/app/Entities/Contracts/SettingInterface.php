<?php
declare(strict_types=1);

namespace App\Entities\Contracts;

/**
 * Interface SettingInterface
 * @package App\Entities\Contracts
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Setting whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Setting whereUpdatedAt($value)
 * @mixin \Eloquent
 */
interface SettingInterface extends EntityInterface
{
  //
}
