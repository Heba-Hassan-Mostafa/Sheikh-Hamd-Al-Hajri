<div>

    
    <div class="row">
        <!--Users-->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $all_user }}</h3>

                <p>{{ trans('admin/template/common.text_users') }}</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ adminUrl('user') }}" class="small-box-footer">{{ trans('admin/template/common.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!--lessons-->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $lesson }}</h3>

                <p>{{ trans('admin/template/common.lessons') }}</p>
              </div>
              <div class="icon">
                <i class="fas fa-book-reader"></i>
                </div>
              <a href="{{ adminUrl('lesson') }}" class="small-box-footer">{{ trans('admin/template/common.more_info') }}<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

           <!--lectures-->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $lecture }}</h3>

                <p>{{ trans('admin/template/common.text_lecture') }}</p>
              </div>
              <div class="icon">
                <i class="fas fa-book"></i>
              </div>
              <a href="{{ adminUrl('lecture') }}" class="small-box-footer">{{ trans('admin/template/common.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!--speeches-->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $speech }}</h3>

                <p>{{ trans('admin/template/common.text_speech') }}</p>
              </div>
              <div class="icon">
                <i class="fas fa-microphone-alt"></i>
              </div>
              <a href="{{ adminUrl('speech') }}" class="small-box-footer">{{ trans('admin/template/common.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

            <!--articles-->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-art">
                  <div class="inner">
                    <h3>{{ $article }}</h3>
    
                    <p>{{ trans('admin/template/common.text_article') }}</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-pen-square"></i>
                  </div>
                  <a href="{{ adminUrl('article') }}" class="small-box-footer">{{ trans('admin/template/common.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>


               <!--books-->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-book">
                  <div class="inner">
                    <h3>{{ $book }}</h3>
    
                    <p>{{ trans('admin/template/common.text_book') }}</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-swatchbook"></i>
                  </div>
                  <a href="{{ adminUrl('book') }}" class="small-box-footer">{{ trans('admin/template/common.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

                   <!--bensfits-->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-bene">
                  <div class="inner">
                    <h3>{{ $benefit }}</h3>
    
                    <p>{{ trans('admin/template/common.text_benefits') }}</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-hand-holding-heart"></i>
                  </div>
                  <a href="{{ adminUrl('religious-benefits') }}" class="small-box-footer">{{ trans('admin/template/common.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

                        <!--bensfits-->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-fat">
                  <div class="inner">
                    <h3>{{ $fatwas }}</h3>
    
                    <p>{{ trans('admin/template/common.fatwas') }}</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-question-circle"></i>
                  </div>
                  <a href="{{ adminUrl('fatwas') }}" class="small-box-footer">{{ trans('admin/template/common.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
         
    </div>
</div>
