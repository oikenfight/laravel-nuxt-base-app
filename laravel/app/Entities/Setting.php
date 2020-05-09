<?php

namespace App\Entities;

use App\Entities\Contracts\SettingInterface;

/**
 * Class Setting
 *
 * @package App\Entities
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
class Setting extends Entity implements SettingInterface
{
    //
}
