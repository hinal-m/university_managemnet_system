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

    <h2>College Reserved Admission</h2>

    <table>
        <tr>
            <th>College Id</th>
            <th>Course Id</th>
            <th>User Id</th>
            <th>Merit</th>
            <th>Admission Date</th>
            <th>Admission Code</th>
        </tr>
        @foreach ($reserveAdmission as $reserveAdmissions)
        <tr>
            <td>{{ $reserveAdmissions->college_id }}</td>
                <td>{{ $reserveAdmissions->course_id }}</td>
                <td>{{ $reserveAdmissions->user_id}}</td>
                <td>{{ $reserveAdmissions->merit }}</td>
                <td>{{ $reserveAdmissions->addmission_date }}</td>
                <td>{{ $reserveAdmissions->addmission_code }}</td>
            </tr>
            @endforeach
    </table>

</body>

</html>

