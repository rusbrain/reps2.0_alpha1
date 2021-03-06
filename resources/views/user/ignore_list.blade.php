@extends('layouts.site')
@inject('general_helper', 'App\Services\GeneralViewHelper')

@section('sidebar-left')
    @include('sidebar-widgets.votes')

    @include('sidebar-widgets.gosu-replays')
@endsection

@section('content')
    <!-- Breadcrumbs -->
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li>
                    <a href="/">Главная</a>
                </li>
                <li>
                    <a href="{{route('user_profile',['id' =>Auth::id()])}}">/ Мой Аккаунт</a>
                </li>
                <li>
                    <a href="" class="active">/ Список игнорируемых пользователей</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END Breadcrumbs -->

    <div class="content-box">
        <div class="col-md-12 section-title">
            <div>Список игнорируемых пользователей</div>
        </div>
        <div class="table-wrapper">
            <table class="table user-friends-list-table">
                <thead>
                <tr>
                    <td scope="col">#</td>
                    <td scope="col">Аватар</td>
                    <td scope="col">Имя</td>
                    <td scope="col">Дата</td>
                    <td scope="col">Действие</td>
                </tr>
                </thead>
                <tbody>
                @if($users->count() > 0)
                    @foreach($users as $k => $item)
                        <tr>
                            <td scope="row">{{$k}}</td>
                            <td>
                                @if($item->view_avatars == 1)
                                    @if($item->avatar)
                                        <a href="" class="logged-user-avatar">
                                            <img src="{{$item->avatar->link}}">
                                        </a>
                                    @else
                                        <a href="" class="logged-user-avatar">A</a>
                                    @endif
                                @else
                                    <a href="" class="logged-user-avatar">A</a>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('user_profile',['id'=>$item->ignored_user_id])}}">{{$item->ignored_user->name}}</a>
                            </td>
                            <td>{{$item->created_at}}</td>
                            <td class="user-list-action">
                                <a href="{{route('user.set_not_ignore',['id' => $item->ignored_user_id])}}" class="delete-friend"></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="">
                        <td colspan="5">В данный момент список пуст</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div><!-- close div /.content-box -->
@endsection

@section('sidebar-right')
    <!--Banners-->
    @include('sidebar-widgets.banner')
    <!-- END Banners -->

    <!-- New Users-->
    @include('sidebar-widgets.new-users')
    <!-- END New Users-->

    <!-- User's Replays-->
    @include('sidebar-widgets.users-replays')
    <!-- END User's Replays-->

    <!-- Gallery -->
    @include('sidebar-widgets.random-gallery')
    <!-- END Gallery -->
@endsection