@extends('layouts.master')

@section('content')
    <div class="pull-right" style="color: green; font-size: 25px; background: #efefef; padding: 0px 10px ">
        {{ Session::get('key') }}
    </div>
    <h2> {{ $data }} </h2>

    {!! Form::open(array('action' => 'WelcomeController@email_index')) !!}
        <div class="form-group">
            {!! Form::label('subject', "Subject : ") !!}
            {!! Form::text('subject', " Dedicated Server", ['class'=>'form-control', 'required', 'autofocus']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email_address', "Email Address") !!}
            {!! Form::text('email_address', null, ['class'=>'form-control',  'required' ]) !!}
        </div>

        <?php
            $body = 'We are interested in learning more about the  dedicated (or vps if vps) server.  Do you have any in stock?  We would also request a /24 of ipv4 space routed to the server for our needs.  Can you help us with this?'
        ?>
        <div class="form-group">
            {!! Form::label('body', "Body") !!}
            {!! Form::textarea('body', $body, ['class'=>'form-control', 'required' ]) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Send Email', ['class'=>'btn btn-success']); !!}
        </div>

    {!! Form::close() !!}



@stop