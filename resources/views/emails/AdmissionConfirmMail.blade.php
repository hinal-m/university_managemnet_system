@component('mail::message')

Hello Student, Your admission is confrim, your confirmssion id :- {{$admission->addmission_id}}

<table>
    <tr>
        <th>College Name</th>&nbsp;&nbsp;
        <th>Merit</th>
    </tr></br>
    <tr>
        <td>{{$admission->colleges->name}}</td>&nbsp;&nbsp;
        <td>{{$admission->confirm_merit}}</td>
    </tr>
</table></br>

Thanks,<br>
@endcomponent
