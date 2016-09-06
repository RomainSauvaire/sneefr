<?php namespace Sneefr\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Sneefr\Models\Ad;
use Sneefr\Models\User;

class AdPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Ad $ad)
    {
        if ($ad->trashed()) {
            abort(410, 'Ad is gone');
        }

        return true;
    }

    public function update(User $user, Ad $ad)
    {
        // Is it the owner of this ad ?
        if ($ad->user_id == $user->getId()) {
            return true;
        }

        // Is it one of the administrators of the shop ?
        if ($ad->shop_id && in_array($user->getId(), $ad->shop->admins->lists('id')->all())) {
            return true;
        }

        // Is ot one of the site admins ?
        if (in_array(auth()->user()->facebook_id, config('sneefr.staff_facebook_ids.administrators'))) {
            return true;
        }

        // If none of that, the user is not allowed to edit the ad
        abort(403, "You are not authorized to edit this ad");
    }

    /**
     * Check this ad is locked for the current user.
     *
     * @param \Sneefr\Models\User $user
     * @param \Sneefr\Models\Ad   $ad
     *
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    public function buy(User $user, Ad $ad)
    {
        if (! $ad->isInShop() && ! $ad->isLockedFor($user->getId())) {
            abort(401, trans('feedback.ad_is_not_locked_for_you'));
        }

        return true;
    }

    public function destroy(User $user, $ad)
    {
     
        // Is it the owner of this ad ?
        if ($ad->user_id == $user->getId()) {
            return true;
        }

        // Is it the admin ?
        if ($user->isAdmin()) {
            return true;
        }

        // If none of that, the user is not allowed to remove the ad
        abort(403, "You are not authorized to remove this ad");
    }

    /**
     * Check this user if he is the buyer
     *
     * @param User $user
     * @param Ad $ad
     * @return bool
     */
    public function review(User $user, Ad $ad)
    {
        if (!$ad->buyer || $ad->buyer->getId() != $user->getId()) {
            abort(403, "You are not authorized to review this ad");
        }
        return true;
    }
}
