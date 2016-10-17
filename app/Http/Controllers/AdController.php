<?php

namespace Sneefr\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Sneefr\Events\ItemWasViewed;
use Sneefr\Http\Requests\CreateAdRequest;
use Sneefr\Jobs\DeleteAd;
use Sneefr\Models\Ad;
use Sneefr\Models\Shares;
use Sneefr\Repositories\Discussion\DiscussionRepository;

class AdController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $ad = Ad::withTrashed()->find($id);

        return redirect()->route('items.show', $ad->getSlug(), 301);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int                                  $id
     * @param \Sneefr\Http\Requests\CreateAdRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id, CreateAdRequest $request)
    {
        // Get the ad to edit
        $ad = Ad::findOrFail($id);

        // Check the rights for this user to edit this ad
        $this->authorize('update', $ad);

        // Update the data
        $ad->update($request->except(['images']));

        return redirect()->route('ad.show', $ad)
            ->with('success', trans('feedback.ad_edit_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $adId
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($adId)
    {
        $ad = Ad::findOrFail($adId);

        // Check the rights for this user to remove this ad
        $this->authorize('destroy', $ad);

        $this->dispatch(new DeleteAd($adId));

        return redirect()->home()
            ->with('success', trans('feedback.ad_delete_success', ['url' => route('items.create')]));
    }

    /**
     * Allow the user to choose the buyer of this ad.
     *
     * @param int                                                  $adId
     * @param \Sneefr\Repositories\Discussion\DiscussionRepository $discussionRepository
     *
     * @return \Illuminate\View\View
     */
    public function chooseBuyer(int $adId, DiscussionRepository $discussionRepository)
    {
        // Todo: check if ad is not locked
        // Get the ad to edit
        $ad = Ad::findOrFail($adId);

        //$this->authorize('edit', $ad);
        if ($ad->user_id != auth()->id() && ! auth()->user()->isAdmin()) {
            return redirect('/');
        }

        // Persons with the ad in discussion
        $discussing = $discussionRepository->discussingAd($ad->getId());

        // Discussions without the ad
        $notDiscussing = $discussionRepository->of(auth()->id())
            ->reject(function ($discussion) use ($discussing) {
                return in_array($discussion->id, $discussing->pluck('id')->toArray());
            });

        return view('discussions.chooseBuyer', compact('discussing', 'notDiscussing', 'ad'));
    }

    /**
     * Generate the fragement needed by a discussion for a specific ad.
     *
     * @param int                                                  $adId
     * @param \Illuminate\Http\Request                             $request
     * @param \Sneefr\Repositories\Discussion\DiscussionRepository $discussionRepository
     *
     * @return mixed
     * @throws \Exception
     */
    public function getAdFragment(int $adId, Request $request, DiscussionRepository $discussionRepository)
    {
        // Get the specific discussion
        $discussion = $discussionRepository->get($request->input('discussion_id'));

        // Ads in this discussion
        $ads = $discussion->allAds->sortByDesc('pivot.updated_at');

        foreach ($ads as $ad) {
            if ($ad->getId() == $adId) {
                $data = [
                    'fragment' => view('discussions._ad')->with([
                        'ad'                => $ad,
                        'currentDiscussion' => $discussion,
                    ])->render(),
                ];

                return response()->json($data);
            }
        }

        abort(404);
    }
}
