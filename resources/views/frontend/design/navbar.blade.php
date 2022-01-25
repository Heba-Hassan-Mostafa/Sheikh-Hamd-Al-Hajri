
    @include('frontend.design.menu')
    <!-- start last nav-bar-->
    <div class="last-nav">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark primary-color">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              
              <li class="nav-item"><i class="fas fa-home"></i><a class="nav-link" href="{{ route('frontend.index') }}" title={{ trans('frontend/index/index.home') }}>{{ trans('frontend/index/index.home') }}</a></li>
              <li class="nav-item"><i class="fas fa-user-alt"></i><a class="nav-link" href="{{ route('frontend.about.sheikh') }}" title={{ trans('frontend/index/index.about_title') }}>{{ trans('frontend/index/index.about') }}</a></li>
              <li class="nav-item"><i class="fas fa-book-reader"></i><a class="nav-link" href="{{ route('frontend.lessons.lessons')}}" title={{ trans('frontend/index/index.lessons') }}>{{ trans('frontend/index/index.lessons') }}</a></li>
              <li class="nav-item"><i class="fas fa-book"></i><a class="nav-link" href="{{ route('frontend.lectures.lectures')}}" title={{ trans('frontend/index/index.lectures') }}>{{ trans('frontend/index/index.lectures') }}</a></li>
              <li class="nav-item"><i class="fas fa-microphone-alt"></i><a class="nav-link" href="{{ route('frontend.speeches.speeches')}}" title={{ trans('frontend/index/index.speeches') }}>{{ trans('frontend/index/index.speeches') }}</a></li>
              <li class="nav-item"><i class="fas fa-pen-square"></i><a class="nav-link" href="{{ route('frontend.articles.articles') }}" title={{ trans('frontend/index/index.articles') }}>{{ trans('frontend/index/index.articles') }}</a></li>
              <li class="nav-item"><i class="fas fa-swatchbook"></i><a class="nav-link" href="{{ route('frontend.books.books') }}" title={{ trans('frontend/index/index.books_title') }}>{{ trans('frontend/index/index.books') }}</a></li>
              <li class="nav-item"><i class="fas fa-question-circle"></i><a class="nav-link" href="{{ route('frontend.answers.qustions') }}" title={{ trans('frontend/index/index.questions_title') }}>{{ trans('frontend/index/index.questions') }}</a></li>
              <li class="nav-item dropdown"><i class="fas fa-film"></i><a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('frontend/index/index.library') }}</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink"><a class="dropdown-item" href="{{ route('frontend.videos.all-videos') }}" title={{ trans('frontend/index/index.videos_title') }}>{{ trans('frontend/index/index.videos') }}</a>
                  <a class="dropdown-item" href="{{ route('frontend.audios.all-audios') }}"title={{ trans('frontend/index/index.audios_title') }}>{{ trans('frontend/index/index.audios') }}</a></div>
              </li>
              <li class="nav-item"><i class="fas fa-hand-holding-heart"></i><a class="nav-link" href="{{ route('frontend.religious-benefits.benefits') }}" title={{ trans('frontend/index/index.benefits_title') }}>{{ trans('frontend/index/index.benefits') }}</a></li>
              <li class="nav-item"><i class="fas fa-user-edit"></i><a rel="nofollow" class="nav-link" href="{{ setting()->blog }}" target="_blank" title={{ trans('frontend/index/index.blog') }}>{{ trans('frontend/index/index.blog') }}
                  <!-- start slider images--></a></li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
 