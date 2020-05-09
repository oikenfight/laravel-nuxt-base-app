<?php
declare(strict_types=1);

namespace App\Http\Repositories\Contracts;

namespace App\Repositories\Contracts;

use App\Entities\Contracts\NoteInterface;
use App\Repositories\Exceptions\NoteNotFoundException;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface NoteRepositoryInterface
 *
 * @package App\Repositories\Contracts
 */
interface NoteRepositoryInterface extends RepositoryInterface
{
    /**
     * NoteRepositoryInterface constructor.
     *
     * @param NoteInterface $note
     */
    public function __construct(NoteInterface $note);

    /**
     * @return NoteRepositoryInterface
     */
    public function resetQuery(): NoteRepositoryInterface;

    /**
     * @param array $inputs
     *
     * @return NoteInterface
     */
    public function create(array $inputs): NoteInterface;

    /**
     * @param int $noteId
     *
     * @return NoteInterface
     * @throws NoteNotFoundException
     */
    public function find(int $noteId): NoteInterface;

    /**
     * @param int $noteId
     * @param array $inputs
     *
     * @return NoteInterface
     * @throws NoteNotFoundException
     */
    public function update(int $noteId, array $inputs): NoteInterface;

    /**
     * @param int $noteId
     *
     * @return bool
     * @throws NoteNotFoundException
     */
    public function delete(int $noteId): bool;

    /**
     * @return Collection|NoteInterface[]
     */
    public function all(): Collection;

    // /**
    //  * @param FilterInterface $filter
    //  *
    //  * @return NoteRepositoryInterface
    //  */
    // public function filtering(FilterInterface $filter): NoteRepositoryInterface;

    /**
     * @return int
     */
    public function count(): int;
}
