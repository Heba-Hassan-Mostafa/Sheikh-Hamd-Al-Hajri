@section('header')
<meta name="keywords" content="خطب,الشيخ,حمد,الهاجرى,دينية,اسلامية,مقاطع,صوتية,مرئية,تحميل">
<meta name="description" content="خطب الشيخ الدكتور حمد بن محمد الهاجرى فى علوم الشريعة والفقة المقارن والسياسة الشرعية">
<meta name="author" content="{{ setting()->siteName }}">
@endsection
@include('frontend.design.header')

  <body>
    <div class="overlay"></div>
    <header>
      <!-- start first-nav-->
      @include('frontend.design.navbar')

    </header>
    <div class="container">
      <h1 class="benefits-name">{{ trans('frontend/index/index.speeches') }}</h1>
      <div class="nav-list">
         <ul class="row">
          <li class="col-sm-6 col-md-2 col-lg-3"><a  href="{{ route('frontend.speeches.speeches')}}">{{ trans('frontend/pages/all.all') }}</a></li>
          @foreach($global_categories as $category)
          <li class="col-sm-6 col-md-2 col-lg-3"><a  href="{{ route('frontend.category.speeches', $category->slug )}}" title=" {{ $category->name }} "> {{ $category->name }} </a></li>
         @endforeach
        </ul>
      </div>
      <div class="topic-name">
        <table class="table" id="paginationNumbers" width="100%">
          <thead class="nav-title">
            <tr>
              <th class="th-sm name">{{ trans('frontend/pages/all.address') }}</th>
              <th class="th-sm views">{{ trans('frontend/pages/all.view_num') }}</th>
              <th class="th-sm down">{{ trans('frontend/pages/all.down_num') }} </th>
              <th class="th-sm date">{{ trans('frontend/pages/all.date') }}</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($speeches as $speech)
            <tr class="details-box">
              <td class="title-name"><i class="fas fa-microphone-alt icon"></i><a href="{{ route('frontend.speeches.speech-content' , $speech->slug) }}" title="{{ $speech->name }}">{{\Illuminate\Support\Str::limit( $speech->name, 30 ,'.....') }}</a></td>
              <td class="views">{{ $speech->view_count }}</td>
              <td class="down">{{ $speech->download_count }}</td>
              <td class="date">{{ $speech->publish_date }}</td>
            </tr>
           
            @empty
                
            @endforelse
          
          </tbody>
        </table>
      </div>
    </div>
    <!--start footer-->
    @include('frontend.design.footer')

  </body>
</html>