@section('header')
<meta name="keywords" content="المكتبة,الصوتية,الشيخ,حمد,الهاجرى,دينية,اسلامية,مقاطع,صوتية,مرئية,تحميل">
<meta name="description" content="المكتبة الصوتية للشيخ الدكتور حمد بن محمد الهاجرى فى علوم الشريعة والفقة المقارن والسياسة الشرعية">

<meta name="author" content="{{ setting()->siteName }}">
@endsection
@include('frontend.design.header')

  <body>
    <div class="overlay"></div>
    <header>
       <!-- start first-nav-->
       @include('frontend.design.navbar')

    </header>
    <h1 class="lib-videos-text"> <i class="fas fa-microphone-alt"></i>{{ trans('frontend/index/index.audios') }}</h1>
    <div class="container">
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
            @forelse ($audios as $audio)
            <tr class="details-box">
              <td><i class="fas fa-volume-up listen"></i><a href="{{ route('frontend.audios.audio-content' , $audio->slug) }}" title="{{ $audio->name }}">{{\Illuminate\Support\Str::limit( $audio->name, 25 ,'.....') }}</a></td>
              <td class="views">{{ $audio->view_count }}</td>
              <td class="down">{{ $audio->download_count }}</td>
              <td class="date">{{ $audio->publish_date }}</td>
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