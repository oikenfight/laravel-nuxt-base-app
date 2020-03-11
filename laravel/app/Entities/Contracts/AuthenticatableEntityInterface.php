<?php
declare(strict_types=1);

namespace App\Entities\Contracts;

use Laravel\Passport\Token;

/**
 * Interface AuthenticatableEntityInterface
 *
 * @package App\Entities\Contracts
 */
interface AuthenticatableEntityInterface
{
    /**
     * Get the current access token being used by the user.
     *
     * @return Token|null
     */
    public function token();

    /**
     * @param string $tokenId
     *
     * @return Token|null
     */
    public function findTokenWithProvider(string $tokenId): ?Token;
}
