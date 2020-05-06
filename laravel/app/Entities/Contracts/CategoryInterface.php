<?php
declare(strict_types=1);

namespace App\Entities\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * CategoryInterface interface
 *
 * @package App\Entities\Contracts
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Note[] $notes
 * @property-read array $note_ids
 * @property-read \App\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereRackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Category whereUserId($value)
 */
interface CategoryInterface extends EntityInterface
{
    /**
     * @return array
     */
    public function getNoteIdsAttribute(): array;

    /**
    * @return BelongsTo|UserInterface
    */
    public function user();

    /**
    * @return hasMany|NoteInterface[]
    */
    public function notes();
}
