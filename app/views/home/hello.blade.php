@section('content')
	<div class="welcome">

        @foreach($facebookUser as $key => $value)
            <p>{{ $key }} -> {{ $value }}</p>
        @endforeach

        {{ HTML::decode( HTML::link( 'https://www.facebook.com/' . $facebookUser['id'] , HTML::image(URL::asset('https://graph.facebook.com/' . $facebookUser['id'] . '/picture?height=100&width=100'), null, array('class' => 'img-responsive, img-circle') ), array('target' => '_top') )) }}
		<h3>You have arrived.</h3>
        <div class="row">

            <div class="col-xs-4">
                <button type="button" id="hello_user" class="btn btn-primary">User data</button>
            </div>

                    <div class="col-xs-4">
                        <button type="button" id="invite_friends" class="btn btn-primary">Invite friends</button>
                    </div>

                    <div class="col-xs-4">
                        <button type="button" id="post_to_wall" class="btn btn-primary">Publish</button>
                    </div>
                </div>

        <div class="row">
                 <h3>Share</h3>

                        <div class="col-xs-4 col-xs-offset-4">
                            <p>Share Via email<br>
                            <span class="small">Separate emails with ','</span></p>
                            {{ Form::open( array( 'url' => 'ajaxform', 'class' => 'form-inline', 'id'  => 'form_email' ) ) }}

                            <div class="form-group">
                                <div class="input-group">
                                    {{ Form::text('emails', '', array('placeholder'=> 'friends emails', 'class' => 'form-control', 'required' => 'required')) }}
                                </div>
                            </div>

                            {{ HTML::link('#', 'Send', array('id' => 'invite_email', 'class' => 'btn btn-info')) }}
                            {{ Form::close() }}
                        </div>
                    </div>


	</div>

@stop

@section('js')
    @parent
    {{ HTML::script('js/data.js') }}
@stop
