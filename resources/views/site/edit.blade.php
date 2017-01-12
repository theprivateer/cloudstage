@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit Site</h3>
                </div>

                {!! Form::model($site) !!}
                <div class="panel-body">
                    <!-- Subdomain Form Input -->
                    <div class="form-group">
                        {!! Form::label('subdomain', 'Subdomain:') !!}
                        <div class="input-group">
                            {!! Form::text('subdomain', null, ['class' => 'form-control text-right', 'disabled']) !!}
                            <div class="input-group-addon">.{{ env('HOSTED_ZONE_DOMAIN') }}</div>
                        </div>
                    </div>

                    <!-- Type Form Input -->
                    <div class="form-group">
                        {!! Form::label('type', 'Type:') !!}
                        {!! Form::select('type', ['A' => 'A Record', 'CNAME' => 'CNAME Record'], null, ['class' => 'form-control', 'disabled']) !!}
                    </div>

                    <!-- Target Form Input -->
                    <div class="form-group">
                        {!! Form::label('target', 'Target:') !!}
                        {!! Form::text('target', null, ['class' => 'form-control', 'placeholder' => '127.0.0.1, example.com']) !!}
                    </div>

                    <!-- Ttl Form Input -->
                    <div class="form-group">
                        {!! Form::label('ttl', 'TTL:') !!}
                        {!! Form::text('ttl', 60, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="panel-footer">
                    {!! Form::submit('Save Changes', ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('site.index') }}" class="btn btn-default">Cancel</a>
                </div>
                {!! Form::close() !!}
            </div>

            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">Danger Zone</h3>
                </div>

                <div class="panel-body">
                    <p>Delete site</p>

                    {!! Form::open(['route' => 'site.destroy', 'method' => 'DELETE', 'role' => 'delete-site']) !!}
                    {!! Form::hidden('uuid', $site->uuid) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    @parent
    <script src="/js/bootbox.js"></script>

    <script>
        $(document).on('submit', '[role="delete-site"]', function (e) {
            e.preventDefault();

            var theForm = this;

            bootbox.confirm('Are you sure you want to delete this site?', function(result) {
                if(result)
                {
                    theForm.submit();
                }
            });
        });
    </script>
@endsection