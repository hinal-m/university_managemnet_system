@extends('User.layouts.master')
@section('title', 'Seller-Dashbboard')
@section('content')
    <div class="content-overlay"></div>
    <div class="content-wrapper">

        @if ($declare_date)
            @if (isset($collegemerit) && !empty($collegemerit))
                @if($admission->status == 3)
                <button type="submit"
                            data-id="{{ $collegemerit->id ?? '' }}" class="btn gradient-pomegranate big-shadow confirm"
                            name="confirm">Confirmed</button>
                @endif

                {{-- <a href="{{ route('user.addmission.create') }}" type="submit" data-id="4" class="btn gradient-mint shadow-z-4 confirm "
                    name="confirm">Next
                </a>

                <a  type="submit" data-id="2" class="btn gradient-mint shadow-z-4 confirm" name="confirm">Rejected</a><br> --}}
                <h3>You have shortlisted on merit you are eligible for ({{ $collegemerit->name ?? '' }})

                    {{-- <h3>You have shortlisted on merit you are eligible for ({{ $collegemerit->name ?? '' }}) @if ($admission->status == '3')<button type="submit"
                            data-id="{{ $collegemerit->id ?? '' }}" class="btn gradient-pomegranate big-shadow confirm"
                            name="confirm">Confirmed</button> @endif Otherwise <a
                        href="{{ route('user.addmission.create') }}" type="submit" class="btn gradient-mint shadow-z-4 "
                        name="confirm">Next</a> Round .</h3> --}}

                    @if ($admission->status == '1')
                        <h3>You Have All Ready Confirmed!</h3>
                    @endif
            @endif
            <h1 class="abc">{{ isset($message) ? $message : '' }}</h1>
        @else
            <h1>Please Wait !! Addmission Round Declare date comming </h1>
        @endif

    </div>


@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).on("click", '.confirm', function() {
        var id = $(this).data('id');
        swal({
            title: "Are you sure?",
        }).then((result) => {
            if (result) {

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                            .attr('content')
                    },
                    type: 'POST',
                    url: "{{ route('user.confirm') }}",
                    data: {
                        'id': id,
                    },
                    success: function(data) {
                        if (data) {
                            swal(
                                "success");
                                $('.confirm').disable();
                            window.location.href =
                                "{{ route('user.dashboard') }}";
                        }


                    },
                });
            } else {
                swal("Cancelled", "Your record is safe :)", "error");
            }
        });
    });
</script>
