<table class="table table-bordered">
    <thead>
        <tr>
            <th>#IN</th>
            <th>Role</th>
            <th>Name</th>
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
                <td>{{ $certificate->issue->toDateString() }}</td>
                <td>{{ $certificate->expiry->toDateString() }} ({{ $certificate->expiry->diffForHumans() }})</td>
            </tr>
        @endforeach
    </tbody>
</table>