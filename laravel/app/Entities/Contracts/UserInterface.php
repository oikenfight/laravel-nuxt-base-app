<?php
declare(strict_types=1);

namespace App\Entities\Contracts;

/**
 * UserInterface interface
 *
 * @package App\Entities\Contracts
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $email_verified_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Relations\hasMany|RackInterface[] $racks
 * @property-read \Illuminate\Database\Eloquent\Relations\hasMany|FolderInterface[] $folders
 * @property-read \Illuminate\Database\Eloquent\Relations\hasMany|NoteInterface[] $notes
 * @property-read \Illuminate\Database\Eloquent\Relations\hasMany|ItemInterface[] $items
 */
interface UserInterface extends EntityInterface
{
  /**
   * @return \Illuminate\Database\Eloquent\Relations\hasMany|RackInterface[]
   */
  public function racks();

  /**
   * @return \Illuminate\Database\Eloquent\Relations\hasMany|FolderInterface[]
   */
  public function folders();

  /**
   * @return \Illuminate\Database\Eloquent\Relations\hasMany|NoteInterface[]
   */
  public function notes();

  /**
   * @return \Illuminate\Database\Eloquent\Relations\hasMany|ItemInterface[]
   */
  public function items();
}
