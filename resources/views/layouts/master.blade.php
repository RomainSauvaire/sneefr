<!DOCTYPE html>
<html lang="fr">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# product: http://ogp.me/ns/product#">
    <meta charset="UTF-8">
    <title>
        @if ($notifications || $unread)
            ({{ $notifications + $unread }})
        @endif
        @yield('title', 'sneefR')
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@lang('common.site_description')" />

    @section('styles')
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ elixir('css/all.css') }}">
    @show

    {{--
      Is this needed or not ?
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

    --}}

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('apple-touch-icon-152x152.png') }}'" />
    <link rel="icon" type="image/png" href="{{ asset('favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('favicon-16x16.png') }}" sizes="16x16" />
    <meta name="application-name" content="sneefR"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="{{ asset('mstile-144x144.png') }}" />

    <meta name="_google_api_key" content="{{ config('sneefr.keys.GOOGLE_API_KEY') }}" />
    <meta name="_pusher_key" content="{{ config('sneefr.keys.PUSHER_KEY') }}" />
    <meta name="_pusher_channel" content="{{ Auth::check() ? 'private-'.Auth::user()->getRouteKey() : null }}" />
    <meta name="_pusher_cluster" content="{{ config('sneefr.keys.PUSHER_CLUSTER') }}" />
    <meta name="_stripe_key" content="{{ config('services.stripe.key') }}" />
    <meta name="_token" content="{{ csrf_token() }}" />

@yield('social_media')

</head>
<body class="@yield('body')">

    @section('nav')
        @include('partials._nav')
    @show

    @include('partials._feedback')

    @yield('content')

    @if (! Request::is('login') && ! (!auth()->id() && Request::is('/')))
        @yield('modals')
        {{-- Empty modal content, injected via ajax --}}
        <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalLabel" aria-hidden="true">
            <div id="shareModalContent">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <i class="fa fa-spin fa-spinner fa-3x"></i> <br><br>
                            @lang('modal.share.loading')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @section('scripts')
        <script src="{{ elixir('js/all.js') }}"></script>
        <!-- Algolia autocomplete JS -->
        <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
        <script src="https://cdn.jsdelivr.net/hogan.js/3.0/hogan.min.js"></script>
        <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
        <script src="{{ elixir('js/sneefr.autocomplete.js') }}"></script>
        <!-- custom data needed for auto complete  -->
        <input type="hidden" id="auto-complete-image-base-url" value="https://eazkmue.cloudimg.io/bound/50x50/q50/_originals_/">
        <input type="hidden" id="auto-complete-shop-image-base-url" value="https://eazkmue.cloudimg.io/crop/50x50/q75/_shops_/">
        <input type="hidden" id="env" value="{{ app()->environment() }}">
        <input type="hidden" id="base-url" value="{{ url('') }}">
    @show

    @stack('footer-js')

    <script>(function(G,o,O,g,l){G.GoogleAnalyticsObject=O;G[O]||(G[O]=function(){(G[O].q=G[O].q||[]).push(arguments)});G[O].l=+new Date;g=o.createElement('script'),l=o.scripts[0];g.src='//www.google-analytics.com/analytics.js';l.parentNode.insertBefore(g,l)}(this,document,'ga'));ga('create','UA-61083626-1','auto');ga('send','pageview')</script>

    @section('tracking')
    @show

    @if( app()->environment() != 'local' && (!Request::is('discussions*') && ! Request::is('shopDiscussions*')))
        <script>window.intercomSettings = {app_id: "{{ config('sneefr.keys.INTERCOM_APP_ID') }}"};</script>
        <script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/gleb7gr8';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()</script>
    @endif
    
</body>
</html>
