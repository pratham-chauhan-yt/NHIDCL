<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Application Id</th>
            <th>Name</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>IP Address</th>
            <th>Application Date Time</th>
            <th>Status</th>
            <th>Comment</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $index => $item)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ 'NHIDCL/'.date('Y') . '/' . ($item->nhidcl_recruitment_applications_id ?? '') . '/' . ($item?->updated_by ?? $item?->created_by) }}</td>
                <td>{{ $item->name ?? '' }}</td>
                <td>{{ $item->latitude ?? '' }}</td>
                <td>{{ $item->longitude ?? '' }}</td>
                <td>{{ $item->ip_address ?? '' }}</td>
                <td>{{ $item->datetime ?? '' }}</td>
                <td>{{ $item->status ?? '' }}</td>
                <td>{{ $item->comment ?? '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>