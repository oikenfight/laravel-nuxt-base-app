<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Contracts\NoteInterface;
use App\Repositories\Contracts\NoteRepositoryInterface;
use App\Repositories\Exceptions\NoteNotFoundException;
use App\Repositories\Filters\Contracts\FilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class NoteRepository
 *
 * @package App\Repositories
 */
class NoteRepository implements NoteRepositoryInterface
{
    /**
     * @var NoteInterface
     */
    private $eloquent;

    /**
     * @var Builder
     */
    private $query;

    /**
     * NoteRepository constructor.
     *
     * @param NoteInterface $note
     */
    public function __construct(NoteInterface $note)
    {
        $this->eloquent = $note;
        $this->query = $note->newQuery();
    }

    /**
     * @return NoteRepositoryInterface
     */
    public function resetQuery(): NoteRepositoryInterface
    {
        $this->query = $this->eloquent->newQuery();
        return $this;
    }

    /**
     * @return NoteRepository
     */
    protected function orderBy(): self
    {
        $this->query->orderBy('updated_at');
        return $this;
    }

    /**
     * @return int
     */
    public function totalCount(): int
    {
        return $this->query->count(['id']);
    }

    /**
     * @param array $inputs
     *
     * @return NoteInterface
     */
    public function create(array $inputs): NoteInterface
    {
        $note = $this->eloquent->newInstance([
            'user_id' => array_get($inputs, 'user_id'),
            'folder_id' => array_get($inputs, 'folder_id'),
            'name' => array_get($inputs, 'name'),
        ]);
        $note->save();

        return $note;
    }

    /**
     * @param int $noteId
     *
     * @return NoteInterface
     * @throws NoteNotFoundException
     */
    public function find(int $noteId): NoteInterface
    {
        /** @var NoteInterface $note */
        if (!$note = $this->query->find($noteId)) {
            throw new NoteNotFoundException('Note '.$noteId.' not found.');
        };

        return $note;
    }

    /**
     * @param int $noteId
     * @param array $inputs
     *
     * @return NoteInterface
     * @throws NoteNotFoundException
     */
    public function update(int $noteId, array $inputs): NoteInterface
    {
        /** @var NoteInterface $note */
        if (!$note = $this->query->find($noteId)) {
            throw new NoteNotFoundException('Note '.$noteId.' not found.');
        };

        $note->update([
            'user_id' => array_get($inputs, 'user_id'),
            'folder_id' => array_get($inputs, 'folder_id'),
            'name' => array_get($inputs, 'name'),
        ]);

        return $note;
    }

    /**
     * @param int $noteId
     *
     * @return bool
     * @throws NoteNotFoundException
     * @throws \Exception "No primary key defined on model." のケースだが、 Eloquent の責務に於いてテストが終わっているものと考え、ここで \Exception::class を受ける処理や test は書かない。
     */
    public function delete(int $noteId): bool
    {
        /** @var NoteInterface $note */
        if (!$note = $this->query->find($noteId)) {
            throw new NoteNotFoundException('Note '.$noteId.' not found.');
        };

        $result = $note->delete();

        return $result;
    }

    /**
     * @return Collection|NoteInterface[]
     */
    public function all(): Collection
    {
        $this->orderBy();
        return $this->query->get();
    }

    // /**
    //  * @param FilterInterface $filter
    //  *
    //  * @return NoteRepositoryInterface
    //  */
    // public function filtering(FilterInterface $filter): NoteRepositoryInterface
    // {
    //     $filter->apply($this->query);
    //     return $this;
    // }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->query->count(['id']);
    }
}
