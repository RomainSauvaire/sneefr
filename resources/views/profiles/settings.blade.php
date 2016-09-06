@extends('layouts.master')

@section('title', trans('profile.parameters.page_title'))

@section('scripts')
    <script src="//maps.googleapis.com/maps/api/js?libraries=places&key={{ config('sneefr.keys.GOOGLE_API_KEY') }}"></script>
    @parent
@stop

@section('modals')
    @parent
    @include('partials.modals._delete_account', ['hash' => auth()->user()->getRouteKey()])
@stop

@section('content')
    <header class="cover">
        @include('profiles._header', ['person' => $person])
    </header>

    <div class="timeline">
        <div class="row">
            <div class="col-md-4">
                @include('profiles._sidebar', [
                    'person'           => $person,
                    'ads'              => $ads,
                    'isMine'           => $isMine,
                    'followedPlaces'   => $followedPlaces,
                    'searches'         => $searches,
                    'followingPersons' => $followingPersons,
                    'followedPersons'  => $followedPersons,
                    'commonPersons'    => $commonPersons,
                    'isFollowed'       => $isFollowed,
                    'evaluationRatio'  => $evaluationRatio,
                    'soldAds'          => $soldAds,
                ])
            </div>

            <div class="col-md-8">

                {{-- General info such as email and geoloc panel --}}
                @include('profiles.settings.general')

                {{-- Phone validation panel --}}
                @include('profiles.settings.phone')

                {{-- Payment account panel--}}
                @include('profiles.settings.payment')

            {{--
                Settings panel for application config.
            --}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-cog"></i>
                    @lang('profile.parameters.application_settings')
                </div>
                <div class="panel-body">

                    {{-- Create an HTML form for sending changes of application settings --}}
                    {!! Form::open(['route'=>['profiles.settings.update', auth()->user()], 'method'=>'put']) !!}

                    <input type="hidden" name="settings_category" value="application">

                    <div class="form-group row col-md-12">
                        <label>
                            {{-- Control to choose the locale of the application --}}
                            @lang('profile.parameters.app_locale_label')
                        </label>
                        <select name="locale" id="locale" class="form-control">

                            @foreach (Config::get('app.supported_locales') as $code)
                                <option value="{{ $code }}"
                                @if ($code === auth()->user()->getLanguage()) selected @endif>
                                    @lang('profile.parameters.locale_code_'.$code)
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <button class="btn btn-success" type="submit">
                        @lang('profile.parameters.button_save_notifications')
                    </button>
                    {!! Form::close() !!}
                </div>
            </div>
            {{--
                Settings panel for notifications.
            --}}
            <div class="panel panel-default" id="notifs">
                <div class="panel-heading">
                    <i class="fa fa-bell"></i>
                    @lang('profile.parameters.your_notifications')
                </div>
                <div class="panel-body">

                    {{-- Create an HTML form for sending changes to notification settings --}}
                    {!! Form::open(['route'=>['profiles.settings.update', auth()->user()], 'method'=>'put']) !!}

                    <input type="hidden" name="settings_category" value="notifications">

                    <div class="form-group row">
                        <div class="col-md-12 location">
                            <div class="checkbox">
                                <label>
                                    {{-- Control to enable or disable daily notifications for unread messages --}}
                                    <input name="daily_digest" type="checkbox"
                                            {{ isset(auth()->user()->preferences['daily_digest'])
                                                && auth()->user()->preferences['daily_digest']
                                                ? 'checked="checked"'
                                                : '' }}>
                                    @lang('profile.parameters.daily_digest_label')
                                </label>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-success" type="submit">
                        @lang('profile.parameters.button_save_notifications')
                    </button>
                    {!! Form::close() !!}
                </div>
            </div>


            {{--
                Link to delete account.
            --}}
            <p>
                <a href="#" class="text-danger" data-toggle="modal" data-target="#confirm-delete">@lang('profile.parameters.button_danger_zone')</a>
            </p>
        </div>
    </div>
</div>
@stop
