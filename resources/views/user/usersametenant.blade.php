 @extends('template')
@section('content')
@include('errors.list')
<table class="table table-striped">
  <thead>
    <tr>
      <th>#</th>
      <th>Username</th>
      <th>Email</th>
      <th>Firstname</th>
      <th>Middle</th>
      <th>Lastname</th>
    </tr>
  </thead>
  <tbody>
  	<?php $i = 0 ?>
  	@foreach($listItem as $post)
    <tr>
      <th scope="row">{{ $i+1 }}</th>
      <td><a href="{{URL::route('user.getEditProfile',$post->id)}}">{{$post->username}}</a></td>
      <td>{{$post->email}}</td>
      <td>{{$post->firstname}}</td>
      <td>{{$post->middle}}</td>
      <td>{{$post->lastname}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@stop