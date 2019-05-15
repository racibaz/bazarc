@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!

                        @if($service == 'facebook')
                            <div class="title m-b-md">
                                Welcome {{ $details->user['name']}} ! <br> Your email is : {{
				$details->user['email'] }} <br> You are {{ $details->user['gender']
				}}.
                            </div>
                        @endif @if($service == 'google')
                            <div class="title m-b-md">
                                Welcome {{ $details->name}} ! <br> Your email is : {{
				$details->email }} <br> Your are {{ $details->user['gender'] }}.
                            </div>

                        @endif @if($service == 'twitter')
                            <div class="title m-b-md">
                                Welcome {{ $details->name}} ! <br> Your username is : {{
				$details->nickname }}<br> Total Tweets : {{
				$details->user['statuses_count']}}<br> Followers : {{
				$details->user['followers_count']}}<br> Following : {{
				$details->user['friends_count']}}
                            </div>
                        @endif @if($service == 'github')
                            <div class="title m-b-md">
                                Welcome {{ $details->user['name'] }} ! <br> Your email is : {{
				$details->user['email'] }} <br> Public Repositories :
                                {{$details->user['public_repos']}}<br> Followers :
                                {{$details->user['followers']}}
                            </div>

                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
