@extends('User.layouts.master')
@section('title', 'Seller-Dashbboard')
@section('content')
    {{-- @dd($addmisions_merit[0]['id']) --}}
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <!--Statistics cards Starts-->
        @if ($todate == $merit_round['merit_result_declare_date'])

            <h3>You have shortlisted on merit you are eligible for ({{$college[0]['name']}}) <button type="submit" data-id="{{$college[0]['id']}}" value="{{$addmisions_merit[0]['id']}}" class="btn gradient-pomegranate big-shadow confirm" name="confirm">Confirmed</button> Otherwise <button type="submit" class="btn gradient-mint shadow-z-4 " name="confirm">Next</button> Round .</h3>
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                    <div class="card gradient-purple-love">
                        <div class="card-content">
                            <div class="card-body py-0">
                                <div class="media pb-1">
                                    <div class="media-body white text-left">
                                        <h3 class="font-large-1 white mb-0"></h3>
                                        <span>Total Stores</span>
                                    </div>
                                    <div class="media-right white text-right">
                                        <i class="fa fa-shopping-basket font-large-1"></i>
                                    </div>
                                </div>
                            </div>
                            <div id="" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
                            </div>
                        </div>
                    </div>
                </div>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                    <div class="card gradient-ibiza-sunset">
                        <div class="card-content">
                            <div class="card-body py-0">
                                <div class="media pb-1">
                                    <div class="media-body white text-left">
                                        <h3 class="font-large-1 white mb-0"></h3>
                                        <span>Total Selected Brand</span>
                                    </div>
                                    <div class="media-right white text-right">
                                        <i class="fa fa-superpowers font-large-1"></i>
                                    </div>
                                </div>
                            </div>
                            <div id="" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
                            </div>

                        </div>
                    </div>
                </div>&nbsp;&nbsp;&nbsp;&nbsp;

                <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                    <div class="card gradient-mint">
                        <div class="card-content">
                            <div class="card-body py-0">
                                <div class="media pb-1">
                                    <div class="media-body white text-left">
                                        <h3 class="font-large-1 white mb-0"></h3>
                                        <span>Total Category</span>
                                    </div>
                                    <div class="media-right white text-right">
                                        <i class="ft-list font-large-1"></i>
                                    </div>
                                </div>
                            </div>
                            <div id="" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endif
        <!--Statistics cards Ends-->

    </div>


@endsection
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).on("click", '.confirm', function() {
      var id = $(this).data('id');
      var admission_id = $(this).val('id');
      alert(id);
      alert(admission_id);
      if ($(this).is(':checked', true)) {
         $.ajax({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                  .attr('content')
            },
            type: 'POST',
            url: "",
            data: {
               'id': id
            },
            success: function(data) {
               $("#dis-brand").append("<p id=" + data.data.id +
                  " class='alert alert-secondary category' role='alert'>" + data.data
                  .en_name + "</p>");
            }
         });
      } else {
         $('#' + id).closest('p').remove();
      }
   });
</script>
