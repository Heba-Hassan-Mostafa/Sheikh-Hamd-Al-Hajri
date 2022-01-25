@section('header')
<meta name="keywords" content="اسئلة,اجوبة,فتاوى,الشيخ,حمد">
<meta name="description" content="اسئلة واجوبة الاستاذ الدكتور حمد بن محمد الهاجرى استاذ الفقة المقارن والسياسة الشرعية كلية الشريعة جامعة الكويت">
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
      <h1 class="benefits-name">{{ trans('frontend/index/index.questions') }}</h1>
      <div class="row qustion-ask">
        <div class="topic-name col-lg-6 ask">
          <table class="table" id="paginationNumbers" width="100%">
            <thead class="nav-title nav-title-ask-qus">
              <tr>
                <th class="th-sm name">{{ trans('frontend/index/index.questions') }}</th>
              </tr>
            </thead>
            <tbody class="show-all-qus">
              @forelse ($fatwas as $fatwa)
              <tr class="details-box">
                <td><i class="fas fa-question-circle icon"></i><a href="{{ route('frontend.answers.answers-content', $fatwa->id) }}" title="{{ $fatwa->name }}">{{\Illuminate\Support\Str::limit( $fatwa->message, 100 ,'.....') }}</a>
                  <h6>{{ trans('frontend/pages/all.date') }}<span>{{ $fatwa->created_at->format('M-d-Y') }}</span></h6>
                </td>
              </tr>
              @empty
                
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="fatawa-ask col-lg-5">
          <div class="overlay"></div>
          <h5>{{ trans('frontend/index/index.ques') }}</h5>
          {!! Form::open(['route' =>'frontend.add_fatwas' , 'method'=>'post' , 'class'=>'fill-in']) !!}
    
          {!! Form::text('name' , old('name') , ['class' => 'prev-name form-control' ,'placeholder'=>trans('frontend/index/index.name')]) !!}
          {{-- @error('name')<span class="text-danger">{{ $message }}</span> @enderror --}}
          <span class="error-name"></span>
          {!! Form::email('email' , old('email') , ['class' => 'prev-email form-control' ,'placeholder'=>trans('frontend/index/index.email')]) !!}
          {{-- @error('email')<span class="text-danger">{{ $message }}</span> @enderror --}}
          <span class="error-email"></span>
          {!! Form::textarea('message' , old('message') , ['class' => 'prev-massage form-control' ,'placeholder'=>trans('frontend/index/index.message')]) !!}
          {{-- @error('message')<span class="text-danger">{{ $message }}</span> @enderror --}}
          <span class="error-massage"></span>
          {!! Form::submit(trans('frontend/index/index.send')  , ['class' => 'send-your-ask']) !!}

        {!! Form::close() !!}
        </div>
      </div>
    </div>
     <!--start footer-->
    @include('frontend.design.footer')

   
  </body>
</html>