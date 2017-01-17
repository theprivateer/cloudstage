@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Your Sites</h3>
        </div>

        <table class="table table-striped table-panel">
            <thead>
            <tr>
                <th>Domain</th>
                <th>Record Type</th>
                <th>Target</th>
                <th>TTL</th>
                <th>Expires</th>
                <th class="btn-column"></th>
                <th class="btn-column"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($sites as $site)
                <tr>
                    <td><code>{{ $site->subdomain }}</code>.{{ env('HOSTED_ZONE_DOMAIN') }}</td>
                    <td>{{ $site->type }}</td>
                    <td>{{ $site->target }}</td>
                    <td>{{ $site->ttl }}</td>
                    <td>{{ $site->expires_at('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('site.edit', $site->uuid) }}" class="btn btn-default btn-sm">Edit</a>
                    </td>
                    <td>
                        {!! Form::open(['route' => 'site.destroy', 'method' => 'DELETE', 'role' => 'delete-site']) !!}
                        {!! Form::hidden('uuid', $site->uuid) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-default btn-sm']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
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