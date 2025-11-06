<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Application Id</th>
            <th>Name</th>
            <th>Father/Husband Name</th>
            <th>Mother Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Date Of Birth</th>
            <th>Gender</th>
            <th>Marital Status</th>
            <th>Spouse Name</th>
            <th>Citizenship</th>
            <th>Category</th>
            <th>Aadhaar Number</th>
            <th>Ex Service Man</th>
            <th>Whether you are PwBD or not</th>
            <th>Correspondence Address</th>
            <th>Permanent Address</th>
            <th>GATE Reg No</th>
            <th>GATE Score</th>
        </tr>
    </thead>
    <tbody>
        @foreach($previewData as $index => $item)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ 'NHIDCL/' . date('Y') . '/' . ($item->nhidcl_recruitment_posts_id ?? '') . '/' . ($item?->users?->id ?? '') }}</td>
                <td>{{ $item->users ? $item->users?->name : '' }}</td>
                <td>{{ optional($item->application->first())->father_husband_name }}</td>
                <td>{{ optional($item->application->first())->mother_name }}</td>
                <td>{{ $item->users ? $item->users?->email : '' }}</td>
                <td>{{ $item->users ? $item->users?->mobile : '' }}</td>
                <td>{{ $item->users ? $item->users?->date_of_birth : '' }}</td>

                <td>{{ optional($item->application->first())->gender }}</td>
                <td>{{ optional($item->application->first())->marital_status }}</td>
                <td>{{ optional($item->application->first())->spouse_name }}</td>
                <td>{{ optional($item->application->first())->indian_citizen }}</td>
                <td>{{ optional($item->application->first())->caste->caste ?? '' }}</td>
                <td>{{ optional($item->application->first())->aadhar_number }}</td>
                <td>{{ is_null(optional($item->application->first())->ex_serviceman) ? '' : (optional($item->application->first())->ex_serviceman ? 'Yes' : 'No') }}</td>
                <td>{{ optional($item->application->first())->pwbd ?? '' }}</td>
                <td>
                    {{ implode(
                        ', ',
                        array_filter([
                            optional($item->application->first())->correspondence_address,
                            optional($item->application->first())->correspondence_city,
                            optional($item->application->first())->correspondenceState?->name . ', ' . optional($item->application->first())->correspondence_pincode
                        ]),
                    ) }}
                </td>
                <td>
                    {{ implode(
                        ', ',
                        array_filter([
                            optional($item->application->first())->permanent_address,
                            optional($item->application->first())->permanent_city,
                            optional($item->application->first())->permanentState?->name . ', ' . optional($item->application->first())->permanent_pincode
                        ]),
                    ) }}
                </td>
                <td>{{ optional($item->gatescore->first())->gate_registration_number ?? '' }}</td>
                <td>{{ optional($item->gatescore->first())->gate_score ?? '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<h3>Category-wise Totals</h3>
<table>
    <thead>
        <tr>
            <th>Category</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @php $grandTotal = 0; @endphp
        @foreach($categoryCounts as $category => $count)
            <tr>
                <td>{{ $category }}</td>
                <td>{{ $count }}</td>
            </tr>
            @php $grandTotal += $count; @endphp
        @endforeach
        <tr>
            <td><strong>Grand Total</strong></td>
            <td><strong>{{ $grandTotal }}</strong></td>
        </tr>
    </tbody>
</table>
<h3>PwBD Totals</h3>
<table>
    <thead>
        <tr>
            <th>PwBD</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @php $disabilityTotal = 0; @endphp
        @foreach($disabilityCounts as $disability => $count)
            <tr>
                <td>{{ $disability }}</td>
                <td>{{ $count }}</td>
            </tr>
            @php $disabilityTotal += $count; @endphp
        @endforeach
        <tr>
            <td><strong>Grand Total</strong></td>
            <td><strong>{{ $disabilityTotal }}</strong></td>
        </tr>
    </tbody>
</table>