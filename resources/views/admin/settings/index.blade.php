@extends('admin.layouts.admin') 

@section('content')

<div class="card">
    <div class="card-header">
      <h5 class="card-title">{{ $title }}</h5>
    </div>

    <!-- /.card-header -->
  <div class="card-body">
    {!! Form::model($model,[
                    'action' => ['WebController\SettingController@update', $model->id],
                    'method' => 'put',
                    'files'=>true ,
                    'enctype' =>'multipart/form-data'
                    ])!!}

    <div class="form-group">
      {!! Form::label('siteName',trans('admin/settings/index.sitename')) !!}
      {!! Form::text('siteName',$model->siteName,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
      {!! Form::label('site_right',trans('admin/settings/index.site_right')) !!}
      {!! Form::text('site_right',$model->site_right,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
      {!! Form::label('email',trans('admin/settings/index.email')) !!}
      {!! Form::email('email',$model->email,['class'=>'form-control']) !!}
    </div>
   
    <div class="form-group">
        {!! Form::label('phone',trans('admin/settings/index.phone')) !!}
        {!! Form::text('phone',$model->phone,['class'=>'form-control']) !!}
      </div>
        <div class="form-group">
        {!! Form::label('woman_phone',trans('admin/settings/index.woman_phone')) !!}
        {!! Form::text('woman_phone',$model->woman_phone,['class'=>'form-control']) !!}
      </div>
    <div class="form-group">
        {!! Form::label('facebook_url',trans('admin/settings/index.facebook_url')) !!}
        {!! Form::url('facebook_url',$model->facebook_url,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('twitter_url',trans('admin/settings/index.twitter_url')) !!}
        {!! Form::url('twitter_url',$model->twitter_url,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('youtube_url',trans('admin/settings/index.youtube_url')) !!}
        {!! Form::url('youtube_url',$model->youtube_url,['class'=>'form-control']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('instagram_url',trans('admin/settings/index.instagram_url')) !!}
        {!! Form::url('instagram_url',$model->instagram_url,['class'=>'form-control']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('telegram_url',trans('admin/settings/index.telegram_url')) !!}
        {!! Form::url('telegram_url',$model->telegram_url,['class'=>'form-control']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('blog',trans('admin/settings/index.blog')) !!}
        {!! Form::url('blog',$model->blog,['class'=>'form-control']) !!}
      </div>

    <div class="form-group">
      {!! Form::label('logo',trans('admin/settings/index.logo')) !!}
      <span style="color:red;display:block;font-weight:bold;margin-bottom:5px"> Requirment : an image .png (width:1100px) x (height:230px) </span>
      {!! Form::file('logo',['class'=>'form-control style-inp']) !!}
      @if(!empty(setting()->logo))
      <img src="{{ asset('/files/home/images/'.setting()->logo) }}" style="max-width: 25%;
      margin-top: 10px;" />
     @endif
    </div>
    <div class="form-group">
      {!! Form::label('icon',trans('admin/settings/index.icon')) !!}
      {!! Form::file('icon',['class'=>'form-control style-inp']) !!}
      @if(!empty(setting()->icon))
      <img src="{{ asset('/files/home/images/'.setting()->icon) }}" style="width:50px;height: 50px;" />
     @endif
    </div>
    <div class="form-group">
      {!! Form::label('about_sheikh',trans('admin/settings/index.about_sheikh')) !!}
      {!! Form::textarea('about_sheikh',$model->about_sheikh,['class'=>'form-control'  ,'id'=>'ckeditor']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('keywords',trans('admin/settings/index.keywords')) !!}
      {!! Form::text('keywords',$model->keywords,['class'=>'form-control ']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('description',trans('admin/settings/index.description')) !!}
      {!! Form::textarea('description',$model->description,['class'=>'form-control ']) !!}
    </div>
    {{-- <div class="form-group">
      {!! Form::label('main_languge',trans('admin/settings/index.main_languge')) !!}
      {!! Form::select('main_languge',['ar'=>trans('admin/settings/index.ar'),'en'=>trans('admin/settings/index.en')],$model->main_lang,['class'=>'form-control']) !!}
    </div> --}}
     <div class="form-group">
      {!! Form::label('status',trans('admin/settings/index.status')) !!}
      {!! Form::select('status',['open'=>trans('admin/settings/index.open'),'close'=>trans('admin/settings/index.close')],$model->status,['class'=>'form-control style-inp']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('message_maintenance',trans('admin/settings/index.message_maintenance')) !!}
      {!! Form::textarea('message_maintenance',$model->message_maintenance,['class'=>'form-control']) !!}
    </div>
    {!! Form::submit(trans('admin/settings/index.save'),['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
  <!-- /.box-body -->

</div>


  
@push('ckeditor')

<script src="{{ asset('adminlte/plugins/texteditor/ckeditor/ckeditor.js') }}"></script>
<script>
  CKEDITOR.config.language = 'ar';
  CKEDITOR.config.extraPlugins = 'embedbase';
  CKEDITOR.config.extraPlugins = 'embed';
  CKEDITOR.config.embed_provider = '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}';
  CKEDITOR.replace('ckeditor', {filebrowserImageBrowseUrl: '/file-manager/ckeditor'});
</script>
@endpush 

    @endsection