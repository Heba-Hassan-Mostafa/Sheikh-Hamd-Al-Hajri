@section('header')
<meta name="keywords" content="محاضرات,الشيخ,حمد,الهاجرى,دينية,اسلامية,مقاطع,صوتية,مرئية,تحميل">
<meta name="description" content="محاضرات الشيخ الدكتور حمد بن محمد الهاجرى فى علوم الشريعة والفقة المقارن والسياسة الشرعية">

<meta name="author" content="{{ setting()->siteName }}">
@endsection
@include('frontend.design.header')

  <body>
    <div class="overlay"></div>
    <header>
      <!-- start first-nav-->
      @include('frontend.design.navbar')
      <!-- end first-nav-->
    
    </header>
    <div class="container">
      <h1 class="benefits-name">{{ trans('frontend/index/index.lectures') }}</h1>
      <div class="nav-list">
        <ul class="row">
          <li class="col-sm-6 col-md-2 col-lg-3"><a  href="{{ route('frontend.lectures.lectures')}}">{{ trans('frontend/pages/all.all') }}</a></li>
          @foreach($global_categories as $category)
          <li class="col-sm-6 col-md-2 col-lg-3"><a href="{{ route('frontend.category.lectures', $category->slug )}}" title="{{ $category->name }}"> {{ $category->name }} </a></li>
         @endforeach
        </ul>
      </div>
      <div class="topic-name">
        <table class="table" id="paginationNumbers" width="100%">
          <thead class="nav-title">
            <tr>
              <th class="th-sm name">{{ trans('frontend/pages/all.address') }}</th>
              <th class="th-sm views">{{ trans('frontend/pages/all.view_num') }}</th>
              <th class="th-sm down">{{ trans('frontend/pages/all.down_num') }}</th>
              <th class="th-sm date">{{ trans('frontend/pages/all.date') }}</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($lectures as $lecture)
            <tr class="details-box">
              <td class="title-name"><i class="fas fa-book icon"></i>
                <a href="{{ route('frontend.lectures.lecture-content' , $lecture->slug) }}" title="{{ $lecture->name }}">{{\Illuminate\Support\Str::limit( $lecture->name, 30 ,'.....') }}</a></td>
              <td class="views">{{ $lecture->view_count }}</td>
              <td class="down">{{ $lecture->download_count }}</td>
              <td class="date">{{ $lecture->publish_date }}</td>
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