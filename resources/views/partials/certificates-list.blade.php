<table class="table table-bordered">
    <thead>
        <tr>
            <th>#IN</th>
            <th>Role</th>
            <th>Name</th>
            <th>Company</th>
            <th>Issue Date</th>
            <th>Expiry Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($certificates as $certificate)
            <tr>
                <td>#{{ $certificate->in }}</td>
                <td>{{ $certificate->role }}</td>
                <td>{{ $certificate->name }}</td>
                <td><a href="{{ route('Company.show',$certificate->Company->id) }}">{{ $certificate->Company->name }}</a></td>
                <td>{{ $certificate->issue->toDateString() }}</td>
                <td class="{{ ($certificate->expiry->diffInDays(\Carbon\Carbon::now()) <= 90 || $certificate->expiry->lt(\Carbon\Carbon::now())) ? 'text-danger' : '' }}">{{ $certificate->expiry->toDateString() }} ({{ $certificate->expiry->diffForHumans() }})</td>
            </tr>
        @endforeach
    </tbody>
</table>