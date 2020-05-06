<?php
declare(strict_types=1);

namespace App\Entities\Contracts;

/**
 * UserInterface interface
 *
 * @package App\Entities\Contracts
 * @property int $id
 * @property string|null $provider_id
 * @property string|null $provider_name
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Category[] $categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Folder[] $folders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Item[] $items
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Note[] $notes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Entities\Rack[] $racks
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereProviderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Entities\User whereUpdatedAt($value)
 * @mixin \Eloquent
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany|CategoryInterface[]
     */
    public function categories();
}
