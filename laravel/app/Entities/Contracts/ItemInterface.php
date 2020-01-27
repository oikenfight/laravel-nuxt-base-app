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
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Relations\BelongsTo|UserInterface $user
 * @property-read \Illuminate\Database\Eloquent\Relations\BelongsTo|NoteInterface $note
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