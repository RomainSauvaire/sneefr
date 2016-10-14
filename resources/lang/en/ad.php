<?php

return [
    'show' => [
        'page_title'                 => ":title",
        'btn_contact'                => "Contact",
        'hidden_from_friends'        => "This ad is private, you can't like or share it but you can contact the seller about it",
        'btn_contact_title'          => "Contact :name about this ad",
        'pictures'                   => "Images",
        'relationships'              => "{0} No follower|[1,2] 1 follower|[2,Inf] :nb followers",
        'relationships_title'        => "See :name's followers",
        'relationships_empty'        => "This user doesn't have any follower yet",
        'common_relationships'       => "1 in common| :nb in common",
        'common_relationships_title' => "People you have in common",
        'stock'                      => "{0} No stock | [1, 2] :nb in stock, hurry ! | [2,Inf] :nb in stock",
        'evaluations'                => ":name's reviews",
        'evaluations_positive'       => ":percentage% positive",
        'evaluations_empty'          => ":name doesn't have any review yet",
        'btn_report'                 => "Report this ad",
        'btn_report_title'           => "Does this ad seem inapropriate to you?",
        'btn_evaluations'            => "See all reviews",
        'btn_evaluations_title'      => "See :name's reviews",
        'reported'                   => "You've reported this ad.",
        'btn_remove'                 => "Remove",
        'btn_remove_title'           => "Remove this ad",
        'btn_edit'                   => "Edit",
        'btn_edit_title'             => "Edit this ad",
        'btn_pay'                    => "buy",
        'evaluations_ratio'          => "[-100,-1] No review |[1,Inf] :ratio% positive reviews",
        'delivery_pick'              => "Pick-up instore :",
        'delivery_us'                => "National shipping :",
        'delivery_worldwide'         => "Internationnal schipping :",
        'delevery_fee'               => "{0} Free|[1,Inf] +:fee",
        'ad_detail_title'            => "Article details",
        'ad_shipping_title'         => "Shipping & Conditions",
    ],

    'masked_text'          => "[masked]",
    'gone_title'           => "This ad no longer exists",
    'gone_deleted_text'    => "This ad <strong>:title</strong> has been removed by its seller but here is  <a href=\":url\" title=\"Rechercher :title\">a search with similar objects</a>.",
    'should_connect_first' => "<a href=\":url\" title=\"It's easy and takes less than 5 seconds!\">Login</a> to see if you have people in common with this user",
    'locked_for_edit'      => "This ad hasn't been confirmed yet and is therefore locked for edition.",

    // in link_to_user
    'show_profile_title'   => "See :name's profile",
    
    'remove'                       => [
        'page_title' => "Remove :title",
        'head'       => "Why do you want to remove this ad?",
    ],
    'sold'                         => [
        'page_title'               => "Confirm the sale of :title",
        'head'                     => "Congrats, who did you sell this item to?",
        'head_nobody'              => "You sold this ad outside of sneefR?",
        'head_nobody_text'         => "Congrats. Here is the button to remove it.",
        'discussed_label'          => "People you discussed with about this ad&nbsp;:",
        'other_discussions_label'  => "People you're discussing with&nbsp;:",
        'waiting_for_confirmation' => "Purchase confirmation pending",
    ],
    'sell'                         => [
        'page_title'         => "Confirm the sale of :title",
        'heading'            => "Congrats&nbsp;!",
        'tagline'            => "You're about to sell something to :name",
        'change_buyer'       => "Choose another buyer",
        'change_buyer_title' => "Sell this to someone else",
        'box_heading'        => "Item sold",
        'edit_price'         => "(edit)",
        'edit_price_title'   => "Edit price",
        'choose_pay_method'  => "Choose a payment method",
        'ad_is_locked'       => "Item already marked as sold",
        'pay_secure'         => "secure payment",
        'pay_secure_title'   => "Secure payment",
        'pay_unsecure'       => "other",
        'pay_unsecure_title' => "I don't want a secure payment",
        'pay_cancel'         => "I didn't want to do that (cancel)",
        'pay_cancel_title'   => "I didn't want to do that (cancel)",
        'link_payment_account' => "In order to accept secure payment, please <a href=\":url\" title=\"Go to my settings\">link your stripe account</a>.",

        'tips' => [
            'heading'      => "3 steps to be a good seller",
            'first'        => "Tracking number",
            'first_title'  => "Tracking number",
            'second'       => "Photo of the parcel",
            'second_title' => "Photo of the parcel",
            'third'        => "Be nice ;)",
            'third_title'  => "Be nice ;)",
        ],
    ],
    'buyer'                        => [
        'page_title'             => "Choose buyer",
        'heading'                => "Congrats, who did you sell this to?",
        'tagline'                => "People you discussed with about this ad",
        'heading_not_discussing' => "People you're discussing with",
    ],
    'choose'                       => [
        'page_title'             => "Choose ad",
        'heading'                => "Cool, which item do you want to sell?",
        'tagline'                => "Ads in this discussion",
        'heading_not_discussing' => "Ads outside of this discussion",
    ],
    'remove_from_discussion_title' => "Remove this ad from discussion",
];
