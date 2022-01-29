$(document).ready(function() {
    $('#submit_form').validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true

            },
            address: {
                required: true,

            },
            contact: {
                required: true,
                maxlength: 10,
                digits: true
            },
            password: {
                required: true,
            },
            cpassword: {
                required: true,
                equalTo: "#password"
            },
            logo:{
                required:true
            }

        },
        messages: {
            'name': {
                'required': 'Please Enter  Name'
            },
            'email': {
                'required': 'Please Enter Email'
            },
            'address': {
                'required': 'Please Enter Address'
            },
            'contact': {
                'required': 'Please Enter Mobile No'
            },
            'password': {
                'required': 'Please Enter Password'
            },
            'cpassword': {
                'required': 'Please Confirm Password'
            },
            'logo':{
                'required': 'Please select logo'
            }
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
        },
        submitHandler: function(form) {
            register(form);
        }

    });
});


function register(form) {
    $('.text-strong').html('');
    var form = $('#submit_form');
    var formData = new FormData(form[0]);
    swal({
        title: "Are you sure?",
        text: "you want to Insert College",
    }).then((result) => {
        if (result) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                        .attr('content')
                },
                type: 'POST',
                url: url_collegestore,
                data: formData,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                cache: false,
                success: function(query) {
                    if (query) {
                        swal("Inserted!",
                            "College Inserted Successfully.",
                            "success");
                        window.location.href =
                            "{{ route('university.college.index') }}";
                    }
                },
                error: function(data) {
                    $.each(data.responseJSON.errors, function(
                        key, value) {
                        $('[name=' + key + ']').after(
                            '<span class="text-strong" style="color:red">' +
                            value + '</span>')
                    });
                }
            });
        } else {
            swal("Cancelled", "Your record is safe :)", "error");
        }
    });
}
