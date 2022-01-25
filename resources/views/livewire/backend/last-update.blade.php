<div>
    <div class="row">

        <!-- last lessons -->
        <div class="col-lg-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-success">
                    <h6 class="m-0 font-weight-bold text-primary" style="color: #fff!important">{{ trans('admin/template/common.last_lesson') }}</h6>
                </div>
                <div class="table-responsive">
                    <table class="table" style="text-align: center">
                        <thead>
                        <tr>
                            <th>{{ trans('admin/template/common.text_title') }}</th>
                            <th>{{ trans('admin/template/common.text_status') }}</th>
                            <th>{{ trans('admin/template/common.text_publish_date') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($lessons as $lesson)
                        <tr>
                            <td>{{ \Illuminate\Support\Str::limit($lesson->name, 30, '...') }}</td>
                            <td>{{$lesson->status == 1 ? trans('admin/lessons/create.text_published') : trans('admin/lessons/create.text_hidden') }}</td>
                            <td>{{ $lesson->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">{{ trans('admin/template/common.nolesson')}}</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-info">
                    <h6 class="m-0 font-weight-bold text-primary" style="color: #fff!important">{{ trans('admin/template/common.last_lec') }}</h6>
                </div>
                <div class="table-responsive">
                    <table class="table" style="text-align: center">
                        <thead>
                        <tr>
                            <th>{{ trans('admin/template/common.text_title') }}</th>
                            <th>{{ trans('admin/template/common.text_status') }}</th>
                            <th>{{ trans('admin/template/common.text_publish_date') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($lectures as $lecture)
                            <tr>
                                <td>{{ \Illuminate\Support\Str::limit($lecture->name, 30, '...') }}</td>
                                <td>{{$lecture->status == 1 ? trans('admin/lessons/create.text_published') : trans('admin/lessons/create.text_hidden') }}</td>
                                <td>{{ $lecture->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">{{ trans('admin/template/common.nolec')}}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


          <!-- last speeches -->
          <div class="col-lg-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-danger">
                    <h6 class="m-0 font-weight-bold text-primary" style="color: #fff!important">{{ trans('admin/template/common.last_speech') }}</h6>
                </div>
                <div class="table-responsive">
                    <table class="table" style="text-align: center">
                        <thead>
                        <tr>
                            <th>{{ trans('admin/template/common.text_title') }}</th>
                            <th>{{ trans('admin/template/common.text_status') }}</th>
                            <th>{{ trans('admin/template/common.text_publish_date') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($speeches as $speech)
                        <tr>
                            <td>{{ \Illuminate\Support\Str::limit($speech->name, 30, '...') }}</td>
                            <td>{{$speech->status == 1 ? trans('admin/speeches/create.text_published') : trans('admin/speeches/create.text_hidden') }}</td>
                            <td>{{ $speech->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">{{ trans('admin/template/common.nospeech')}}</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

           <!-- last articles -->
           <div class="col-lg-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary">
                    <h6 class="m-0 font-weight-bold text-primary" style="color: #fff!important">{{ trans('admin/template/common.last_article') }}</h6>
                </div>
                <div class="table-responsive">
                    <table class="table" style="text-align: center">
                        <thead>
                        <tr>
                            <th>{{ trans('admin/template/common.text_title') }}</th>
                            <th>{{ trans('admin/template/common.text_status') }}</th>
                            <th>{{ trans('admin/template/common.text_publish_date') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($articles as $article)
                        <tr>
                            <td>{{ \Illuminate\Support\Str::limit($article->name, 30, '...') }}</td>
                            <td>{{$article->status == 1 ? trans('admin/articles/create.text_published') : trans('admin/articles/create.text_hidden') }}</td>
                            <td>{{ $article->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">{{ trans('admin/template/common.noarticle')}}</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

         <!-- last books -->
         <div class="col-lg-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-book" style="background-color: #7d35dc;">
                    <h6 class="m-0 font-weight-bold text-primary" style="color: #fff!important">{{ trans('admin/template/common.last_book') }}</h6>
                </div>
                <div class="table-responsive">
                    <table class="table" style="text-align: center">
                        <thead>
                        <tr>
                            <th>{{ trans('admin/template/common.text_title') }}</th>
                            <th>{{ trans('admin/template/common.text_status') }}</th>
                            <th>{{ trans('admin/template/common.text_publish_date') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($books as $book)
                        <tr>
                            <td>{{ \Illuminate\Support\Str::limit($book->name, 30, '...') }}</td>
                            <td>{{$book->status == 1 ? trans('admin/books/create.text_published') : trans('admin/books/create.text_hidden') }}</td>
                            <td>{{ $book->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">{{ trans('admin/template/common.nobook')}}</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


          <!-- last benefits -->
          <div class="col-lg-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-bene" style="background-color: #992f18;">
                    <h6 class="m-0 font-weight-bold text-primary" style="color: #fff!important">{{ trans('admin/template/common.last_benefit') }}</h6>
                </div>
                <div class="table-responsive">
                    <table class="table" style="text-align: center">
                        <thead>
                        <tr>
                            <th>{{ trans('admin/template/common.text_title') }}</th>
                            <th>{{ trans('admin/template/common.text_status') }}</th>
                            <th>{{ trans('admin/template/common.text_publish_date') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($benefits as $benefit)
                        <tr>
                            <td>{{ \Illuminate\Support\Str::limit($benefit->name, 30, '...') }}</td>
                            <td>{{$benefit->status == 1 ? trans('admin/benefits/create.text_published') : trans('admin/benefits/create.text_hidden') }}</td>
                            <td>{{ $benefit->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">{{ trans('admin/template/common.nobenefit')}}</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        



    </div>
</div>
</div>
