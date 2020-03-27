<?php
declare(strict_types=1);

use App\Entities\Contracts\FolderInterface;
use App\Entities\Contracts\ItemInterface;
use App\Entities\Contracts\NoteInterface;
use App\Entities\Contracts\RackInterface;
use App\Entities\Contracts\UserInterface;
use Illuminate\Database\Seeder;

/**
 * Class InitDataSeeder
 */
final class InitDataSeeder extends Seeder
{
    const USER_NUM = 3;

    const RACK_NUM = 5;

    const FOLDER_NUM = 5;

    const NOTE_NUM = 5;

    const ITEM_NUM = 5;

    const INIT_ITEM_BODY = [
        "# ITEM ",
        "## sub 1",
        "- list 1 \n - list 2 \n - list 3",
        "## sub 2",
        "row 1 \n\n row 2 \n\n row 3"
    ];

    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @var RackInterface
     */
    private $rack;

    /**
     * @var FolderInterface
     */
    private $folder;

    /**
     * @var NoteInterface
     */
    private $note;

    /**
     * @var ItemInterface
     */
    private $item;

    /**
     * InitDataSeeder constructor.
     * @param UserInterface $user
     * @param RackInterface $rack
     * @param FolderInterface $folder
     * @param NoteInterface $note
     * @param ItemInterface $item
     */
    public function __construct(UserInterface $user, RackInterface $rack, FolderInterface $folder, NoteInterface $note, ItemInterface $item)
    {
        $this->user = $user;
        $this->rack = $rack;
        $this->folder = $folder;
        $this->note = $note;
        $this->item = $item;
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= self::USER_NUM; $i++) {
            $user = $this->userData($i);
            for ($j = 1; $j <= self::RACK_NUM; $j++) {
                $rack = $this->rackData($user, $j);
                for ($k = 1; $k <= self::FOLDER_NUM; $k++) {
                    $folder = $this->folderData($user, $rack, $k);
                    for ($l = 1; $l <= self::NOTE_NUM; $l++) {
                        $note = $this->noteData($user, $folder, $l);
                        for ($m = 1; $m <= self::ITEM_NUM; $m++) {
                            $item = $this->itemData($user, $note, $m);
                        }
                    }
                }
            }
        }
    }

    /**
     * @param int $i
     * @return UserInterface
     */
    private function userData(int $i): UserInterface
    {
        $userInstance = $this->user->newInstance([
            'name' => 'user' . (string)$i,
            'email' => 'user' . (string)$i . '@sample.com',
            'password' => bcrypt('password'),
        ]);
        $userInstance->save();
        return $userInstance;
    }

    /**
     * @param UserInterface $user
     * @param int $j
     * @return RackInterface
     */
    private function rackData(UserInterface $user, int $j): RackInterface
    {
        $rackInstance = $this->rack->newInstance([
            'user_id' => $user->id,
            'name' => 'rack' . (string)$j,
        ]);
        $rackInstance->save();
        return $rackInstance;
    }

    /**
     * @param UserInterface $user
     * @param RackInterface $rack
     * @param int $k
     * @return FolderInterface
     */
    private function folderData(UserInterface $user, RackInterface $rack, int $k): FolderInterface
    {
        $folderInstance = $this->folder->newInstance([
            'user_id' => $user->id,
            'rack_id' => $rack->id,
            'name' => 'rack' . (string)$rack->id . '-folder' . (string)$k,
        ]);
        $folderInstance->save();
        return $folderInstance;
    }

    /**
     * @param UserInterface $user
     * @param FolderInterface $folder
     * @param int $l
     * @return NoteInterface
     */
    private function noteData(UserInterface $user, FolderInterface $folder, int $l): NoteInterface
    {
        $noteInstance = $this->note->newInstance([
            'user_id' => $user->id,
            'folder_id' => $folder->id,
            'name' => 'note' . (string)$l,
        ]);
        $noteInstance->save();
        return $noteInstance;
    }

    private function ItemData(UserInterface $user, NoteInterface $note, int $m): ItemInterface
    {
        $itemInstance = $this->item->newInstance([
            'user_id' => $user->id,
            'note_id' => $note->id,
            'body' => self::INIT_ITEM_BODY[$m - 1],
            'order_index' => $m,
        ]);
        $itemInstance->save();
        return $itemInstance;
    }
}
