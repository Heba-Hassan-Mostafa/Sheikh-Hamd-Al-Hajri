 <!--start footer-->
 <footer>
    <div class="overlay"></div>
    <div class="footer-content row">
      <div class="count-visitors col-md-4">
        <h2 >{{ trans('frontend/index/index.stac') }}</h2>
        <p>
          {{ trans('frontend/index/index.visitnum') }} <span>{{ $visitors->visitor_count }}</span></p>
        
          {!! Form::open(['route'=>'frontend.search' , 'method'=>'get' , 'class'=>'footer-input-search']) !!}
          {!! Form::text('keyword' , old('keyword', request()->keyword) , ['class' => 'form-control input-search' ,'placeholder'=>trans('frontend/index/index.search') ]) !!}
          {!! Form::button('<i class="fas fa-search"></i>',['type'=>'submit' , 'class'=>' accept']) !!}
          {!! Form::close() !!}
      </div>
      <div class="services col-md-4">
        <h3> {{ trans('frontend/index/index.serve') }}</h3>
        <ul>
          <li><a href="{{ route('frontend.about.sheikh') }}" title={{ trans('frontend/index/index.about_title') }}> {{ trans('frontend/index/index.about') }} </a></li>
          <li><a href="{{ route('frontend.religious-benefits.benefits') }}" title={{ trans('frontend/index/index.benefits_title') }}> {{ trans('frontend/index/index.benefits') }}</a></li>
          <li><a href="{{ route('frontend.answers.qustions') }}" title={{ trans('frontend/index/index.questions_title') }}> {{ trans('frontend/index/index.questions') }}</a></li>
          <li><a href="{{ setting()->blog }}" title={{ trans('frontend/index/index.blog') }} rel="nofollow" target="_blank">  {{ trans('frontend/index/index.blog') }}</a></li>
        </ul>
      </div>
      <div class="social-contact-us col-md-4">
        <h5>{{ trans('frontend/index/index.contacts') }}</h5>
        <ul>
          <li><a rel="nofollow" href="{{ setting()->twitter_url }}" target="_blank"  title="twitter"><i class="fab fa-twitter twitter"></i></a></li>
          <li><a  rel="nofollow" href="{{ setting()->instagram_url }}" target="_blank"  title="instagram"><i class="fab fa-instagram instagram"> </i></a></li>
          <li><a rel="nofollow" href="{{ setting()->telegram_url }}" target="_blank"  title="telegram"><i class="fab fa-telegram-plane telegram"></i></a></li>
          <li><a  rel="nofollow" href="{{ setting()->facebook_url }}" target="_blank"  title="facebook"><i class="fab fa-facebook-f facebook"></i></a></li>
        </ul>
        <h6 class="phone-number"> <i class="fab fa-whatsapp whatsapp-footer"></i>
        <img class="gender-icon" src="{{ asset("frontend/images/male.png") }}" title="for men" alt="for men" >
        <a rel="nofollow" href="https://api.whatsapp.com/send?phone=
        {{ setting()->phone }}" target="_blank" title="whatsapp">{{ setting()->phone }}</a></h6>
        
         <h6 class="phone-number"> <i class="fab fa-whatsapp whatsapp-footer"></i>
        <img class="gender-icon" src="{{ asset("frontend/images/female.png") }}" title="for woman" alt="for woman" >
        <a rel="nofollow" href="https://api.whatsapp.com/send?phone=
        {{ setting()->woman_phone }}" target="_blank" title="whatsapp">{{ setting()->woman_phone }}</a></h6>
        
        <h6 class="email-adress"><i class="far fa-envelope-open mail-footer"></i>{{ setting()->email }}</h6>
      </div>
    </div>
    <hr>
    <div class="copy-right"><span>{{ setting()->site_right }} </span>© 2021</div>
    <div class="scrollup"><i class="fas fa-chevron-up"></i></div>
    <div itemscope itemtype="http://schema.org/Movie"></div>
  </footer>

  
  <script src="{{ asset('frontend/plugins/jquery-3.4.1.min.js') }}">     </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="{{ asset('frontend/plugins/bootstrap-4.3.1/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('frontend/js/news.js') }}"></script>
  <script src="{{ asset('frontend/js/pagination.js') }}"></script>
  <script src="{{ asset('frontend/js/aside.js') }}"></script>
  <script src="{{ asset('frontend/js/waypoints-4.0.0.js') }}"></script>
  <script src="{{ asset('frontend/js/jquery.counterup.js') }}"></script>
  <script src="{{ asset('frontend/js/control.count.js') }}"></script>
  <script src="{{ asset('frontend/js/content.js') }}"></script>
  <script src="{{ asset('frontend/js/datatables2.min.js') }}"></script>
  <script src="{{ asset('frontend/js/datatable-pagi.js') }}"></script>
  <script src="{{ asset('frontend/js/scroll-to-top.js') }}"></script>
  <script src="{{ asset('frontend/js/videos-audios.js') }}"></script>
  <script src="{{ asset('frontend/js/custom.js') }}"></script>
  <script>
      (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
          (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
          m = s.getElementsByTagName(o)[0],
          a.async = 1,
          a.src = g;
        m.parentNode.insertBefore(a, m)
      })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

      ga('create', 'G-GBHXKBN92Y', 'auto');
      ga('send', 'pageview');
    </script>
  
  

  