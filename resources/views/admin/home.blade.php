@extends('admin.layouts.admin')
@inject('client','App\Models\Client')
@inject('lesson','App\Models\Lesson')

@section('page_title')

{{ trans('admin/template/common.text_dashboard') }}

@endsection
@section('small_title')

{{ trans('admin/template/common.text_general_statistics') }}

@endsection


@section('content')

  <!-- Main content -->
  <section class="content">
   

    <livewire:backend.statistics />

    <hr>
<div class="row">

    <div class="card card-success col-lg-7" style="margin: auto">
              <div class="card-header">
                <h3 class="card-title">{{ trans('admin/template/common.top_clients') }}</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                  <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 604px;" width="604" height="250" class="chartjs-render-monitor"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>


            <div class="card card-primary col-lg-4" style="margin: auto">
              <div class="card-header">
                <h3 class="card-title">{{trans('admin/template/common.top_visitors')}}</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body"><div class="chartjs-size-monitor">
              <div class="chartjs-size-monitor-expand">
              <div class="">
              </div>
              </div>
              <div class="chartjs-size-monitor-shrink">
              <div class="">
              </div>
              </div>
              </div>
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 604px;" width="604" height="250" class="chartjs-render-monitor">
                </canvas>

              </div>
            </div>

          </div>

                
        <hr>
              <!-- /.card-body -->
            


    <livewire:backend.last-update />



</div>


<!-- /.card -->



  </section>
    <!-- /.content -->
@endsection

    <!-- ChartJS -->
@push('livescript')
    

<script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>


<script>
  $(function () {

    let labelsItems = [];
    let datasetItems = [];
   
       

     $.get('/api/chart/question_chart', { random_id: Math.random() }, function (data)
     {
        labelsItems = data.labels;

          let obj = data.datasets;
         $.each(obj, function (i, text) 
         {
            const r = Math.round(Math.random() * 255);
            const g = Math.round(Math.random() * 255);
            const b = Math.round(Math.random() * 255);

     
     datasetItems.push({
        
                label                       : obj[i].name,
                lineTension                 : 0.3,
                backgroundColor             : "rgba("+ r +", "+ g +", "+ b +", 0.05)",
                borderColor                 : "rgba("+ r +", "+ g +", "+ b +", 1)",
                pointRadius                 : 3,
                pointBackgroundColor        : "rgba("+ r +", "+ g +", "+ b +", 1)",
                pointBorderColor            : "rgba("+ r +", "+ g +", "+ b +", 1)",
                pointHoverRadius            : 3,
                pointHoverBackgroundColor   : "rgba("+ r +", "+ g +", "+ b +", 1)",
                pointHoverBorderColor       : "rgba("+ r +", "+ g +", "+ b +", 1)",
                pointHitRadius              : 10,
                pointBorderWidth            : 2,
                data                        : obj[i].values,
        }
       
        )
 

     })

   

           var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

      
    // This will get the first returned node in the jQuery collection.

   var ctx = document.getElementById("areaChart");
    var areaChart       = new Chart(ctx, { 
      type: 'line',
      data: {
                labels: labelsItems,
                datasets: datasetItems,
            },
      options: areaChartOptions
    })

    


   })
  
})
   
    
   

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    $(function () {

    let labelsItems = [];
    let datasetItems = [];

    $.get('/api/chart/subscriber_chart', { random_id: Math.random() }, function (data) {

         let coloR = [];
        let dynamicColors = function () {
            const r = Math.round(Math.random() * 255);
            const g = Math.round(Math.random() * 255);
            const b = Math.round(Math.random() * 255);

            return "rgb("+ r +", "+ g +", "+ b +")";
        }

        for (let i in data.labels) {
            coloR.push(dynamicColors());
            $("#names_js").append('<span class="mr-2"><i class="fas fa-circle" style="color: ' + coloR[i] + ';"></i> '+ data.labels[i] +'</span>');
            $("#name_js").append('<span class="mr-2"><i class="fas fa-circle" style="color: ' + coloR[i] + ';"></i> '+ data.labels[i] +'</span>');

        }
          labelsItems = data.labels;
        datasetItems.push({
            data: data.datasets.values,
            backgroundColor: coloR,
            hoverBackgroundColor: coloR,
            hoverBorderColor: "rgba(234, 236, 244, 1)",
        })

          var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }

     // You can switch between pie and douhnut using the method below.
     var donutChartCanvas = document.getElementById("donutChart");
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
     data: {
                labels: labelsItems,
                datasets: datasetItems,
            },
      options: donutOptions      
    })


    })
  
   
  })
</script>


@endpush























{{--  @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection  --}}
