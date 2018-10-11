<ul class="nav navbar-nav">
    <!-- Messages: style can be found in dropdown.less-->
    <li class="dropdown messages-menu">
        <!-- Menu toggle button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-envelope-o"></i>
            @php
                $notification = $admin_helper->getNotifications()
            @endphp
            @if($notification['new_messages_count'])<span class="label label-success">{{$notification['new_messages_count']}}</span>@endif
        </a>
        {{--{{$notification['new_messages']->first()->sender->avatar}}--}}
        <ul class="dropdown-menu">
            <li class="header">You have {{$notification['new_messages_count']}} message(s)</li>
            <li>
                <!-- inner menu: contains the messages -->
                <ul class="menu">
                    @foreach($notification['new_messages'] as $message)
                    <li><!-- start message -->
                        <a href="#"> {{--TODO: Add url--}}
                            <div class="pull-left">
                                <!-- User Image -->

                                @if($message->sender->avatar)
                                    <img src="{{route('home').$message->sender->avatar->link}}" class="img-circle" alt="User Image">
                                @else
                                    <img src="{{route('home').'/dist/img/avatar.png'}}" class="img-circle" alt="User Image">
                                @endif
                            </div>
                            <!-- Message title and timestamp -->
                            <h4>
                                {{$message->sender->name}}
                                <small><i class="fa fa-clock-o"></i> {{$message->created_at}}</small>
                            </h4>
                            <!-- The message -->
                            <p>{{substr($message->message, 0, 100)}}</p>
                        </a>
                    </li>
                    @endforeach
                    <!-- end message -->
                </ul>
                <!-- /.menu -->
            </li>
            <li class="footer"><a href="#">See All Messages</a></li> {{--TODO: Add url--}}
        </ul>
    </li>
    <!-- /.messages-menu -->

    <!-- Notifications Menu -->
    <li class="dropdown notifications-menu">
        <!-- Menu toggle button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            @if($notification['all_notification'])
                <span class="label label-warning">{{$notification['all_notification']}}</span>
            @endif
        </a>
        <ul class="dropdown-menu">
            <li class="header">You have {{$notification['all_notification']}} notification(s)</li>
            <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                    @if($notification['new_topics'])
                    <li><!-- start notification -->
                        <a href="#">
                            <i class="fa fa-list text-aqua"></i> {{$notification['new_topics']}} new forum topic(s)
                        </a>
                    </li>
                    @endif
                    @if($notification['new_gosu_replays'])
                    <li><!-- start notification -->
                        <a href="#">
                            <i class="fa fa-film text-aqua"></i> {{$notification['new_gosu_replays']}} new Gosu replay(s)
                        </a>
                    </li>
                    @endif
                    @if($notification['new_user_replays'])
                    <li><!-- start notification -->
                        <a href="#">
                            <i class="fa fa-film text-aqua"></i> {{$notification['new_user_replays']}} new user replay(s)
                        </a>
                    </li>
                    @endif
                    <!-- end notification -->
                </ul>
            </li>
            {{--<li class="footer"><a href="#">View all</a></li>--}}
        </ul>
    </li>
    <!-- Tasks Menu -->
    {{--<li class="dropdown tasks-menu">--}}
        {{--<!-- Menu Toggle Button -->--}}
        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
            {{--<i class="fa fa-flag-o"></i>--}}
            {{--<span class="label label-danger">9</span>--}}
        {{--</a>--}}
        {{--<ul class="dropdown-menu">--}}
            {{--<li class="header">You have 9 tasks</li>--}}
            {{--<li>--}}
                {{--<!-- Inner menu: contains the tasks -->--}}
                {{--<ul class="menu">--}}
                    {{--<li><!-- Task item -->--}}
                        {{--<a href="#">--}}
                            {{--<!-- Task title and progress text -->--}}
                            {{--<h3>--}}
                                {{--Design some buttons--}}
                                {{--<small class="pull-right">20%</small>--}}
                            {{--</h3>--}}
                            {{--<!-- The progress bar -->--}}
                            {{--<div class="progress xs">--}}
                                {{--<!-- Change the css width attribute to simulate progress -->--}}
                                {{--<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"--}}
                                     {{--aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">--}}
                                    {{--<span class="sr-only">20% Complete</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<!-- end task item -->--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li class="footer">--}}
                {{--<a href="#">View all tasks</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</li>--}}
    <!-- User Account Menu -->
    <li class="dropdown user user-menu">
        <!-- Menu Toggle Button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- The user image in the navbar-->
            @if($message->sender->avatar)
                <img src="{{route('home').Auth::user()->avatar->link}}" class="user-image" alt="User Image">
            @else
                <img src="{{route('home').'/dist/img/avatar.png'}}" class="user-image" alt="User Image">
            @endif
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs">{{Auth::user()->name}}</span>
        </a>
        <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
                @if($message->sender->avatar)
                    <img src="{{route('home').Auth::user()->avatar->link}}" class="user-image" alt="User Image">
                @else
                    <img src="{{route('home').'/dist/img/avatar.png'}}" class="user-image" alt="User Image">
                @endif

                <p>
                    {{Auth::user()->name}} - {{Auth::user()->role->name}}
                    @if(Auth::user()->created_at)
                        <small>Member since {{Auth::user()->created_at->format('M. Y')}}</small>
                    @endif
                </p>
            </li>
            <!-- Menu Body -->
            {{--<li class="user-body">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-xs-4 text-center">--}}
                        {{--<a href="#">Followers</a>--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-4 text-center">--}}
                        {{--<a href="#">Sales</a>--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-4 text-center">--}}
                        {{--<a href="#">Friends</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<!-- /.row -->--}}
            {{--</li>--}}
            <!-- Menu Footer-->
            <li class="user-footer">
                <div class="pull-left">
                    <a href="{{route('user_profile',['id'=>Auth::id()])}}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                    <a href="{{route('logout')}}" class="btn btn-default btn-flat">Sign out</a>
                </div>
            </li>
        </ul>
    </li>
    <!-- Control Sidebar Toggle Button -->
</ul>