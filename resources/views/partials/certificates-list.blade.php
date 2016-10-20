<table class="table table-bordered">
    <thead>
        <tr>
            <th>#@lang('certificate.in')</th>
            <th>@lang('certificate.head.role')</th>
            <th>@lang('certificate.head.name')</th>
            <th>@lang('certificate.issue.date')</th>
            <th>@lang('certificate.expiry.date')</th>
            <th>@lang('certificate.renewal.date')</th>
            <th>@lang('certificate.head.status')</th>

            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($certificates as $certificate)
            <tr>
                <td><a href="{{ route('Certificate.show',$certificate->id) }}">#{{ $certificate->in }}</a></td>
                <td>{{ $certificate->role }}</td>
                <td>{{ $certificate->name }}</td>
                <td>{{ $certificate->issue->toDateString() }}</td>
                <td class="{{ ($certificate->expiry->diffInDays(\Carbon\Carbon::now()) <= 90 || $certificate->expiry->lt(\Carbon\Carbon::now())) ? 'text-danger' : '' }}">{{ $certificate->expiry->toDateString() }} ({{ $certificate->expiry->diffForHumans() }})</td>
                <td class="{{ ($certificate->renewal->diffInDays(\Carbon\Carbon::now()) <= 90 || $certificate->renewal->lt(\Carbon\Carbon::now())) ? 'text-danger' : '' }}">{{ $certificate->renewal->toDateString() }} ({{ $certificate->renewal->diffForHumans() }})</td>
                <td>{{ $certificate->status }}</td>
                <td style="min-width: 30px;">
                    <a href="{{ route('Certificate.edit',$certificate->id) }}">
                        <i class="glyphicon glyphicon-edit" title="Edit"></i>
                    </a>

                    <a href="{{ route('Certificate.destroy',$certificate->id) }}">
                        <i class="glyphicon glyphicon-open"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>