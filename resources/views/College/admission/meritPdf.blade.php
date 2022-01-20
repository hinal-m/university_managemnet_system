<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

    </style>
</head>

<body>

    <h2>College Confirm Admission</h2>

    <table>
        <tr>
            <th>Confirm College Id</th>
            <th>Admission Id</th>
            <th>Confirm Round Id</th>
            <th>Confirm Merit</th>
            <th>Confirm Type(M-Merit-Base, R-Reserve-Base)</th>
        </tr>
        @foreach ($meritAdmission as $meritAdmissions)
        <tr>
            <td>{{ $meritAdmissions->confirm_college_id }}</td>
                <td>{{ $meritAdmissions->addmission_id }}</td>
                <td>{{ $meritAdmissions->confirm_round_id}}</td>
                <td>{{ $meritAdmissions->confirm_merit }}</td>
                <td>{{ $meritAdmissions->confirmation_type }}</td>
            </tr>
            @endforeach
    </table>

</body>

</html>

