<?php
declare(strict_types=1);

namespace App\Entities\Contracts;

/**
 * ItemInterface interface
 *
 * @package App\Entities\Contracts
 * @property int $id
 * @property int $user_id
 * @property int $note_id
 * @property string $body
 * @property int $order_index
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Entities\Note $note
 * @property-read \App\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Item whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Item whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Item whereNoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Item whereOrderIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Item whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\Item whereUserId($value)
 */
interface ItemInterface extends EntityInterface
{
  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|UserInterface
   */
  public function user();

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|NoteInterface
   */
  public function note();
}
