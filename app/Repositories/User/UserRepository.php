<?php

namespace Sneefr\Repositories\User;

use Illuminate\Support\Collection;

interface UserRepository
{
    /**
     * Retrieve many User models by their IDs from a social network.
     *
     * @param  array $ids
     * @param  string $network
     *
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function getBySocialNetworkIds(array $ids, $network = 'facebook');

    /**
     * Get the sellers that have the biggest number of ads.
     *
     * @param int   $limit   The number of sellers to retrieve.
     * @param array $userIds (optional) The user identifiers we want to limit.
     *
     * @return \Illuminate\Support\Collection
     */
    public function biggestSellers(int $limit = 3, array $userIds = []) : Collection;

    /**
     * Update a user model and persists.
     *
     * @param array $input
     *
     * @return bool|int
     */
    public function update(array $input);

    /**
     * Get all the users sorted by latest first.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllLatest();
}
