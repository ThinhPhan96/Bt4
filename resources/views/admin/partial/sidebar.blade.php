<div id="sidebar-wrapper" style="margin-left: -70px">
    <ul id="sidebar_menu" class="sidebar-nav">
        <li class="sidebar-brand"><a id="menu-toggle" href="{{url('admin')}}">Menu</a>
        </li>
    </ul>
    <ul class="sidebar-nav" id="sidebar">
        <li><a href="{{route('book.index')}}" style="background-color: #222">Sách<i class="fa fa-book"
                                                                                    aria-hidden="true"></i></a></li>
        <li><a href="{{route('author.index')}}" style="background-color: #222">Tác giả<i class="fa fa-address-book"
                                                                                         aria-hidden="true"></i></a>
        </li>
        <li><a href="{{route('root.index')}}" style="background-color: #222">Tài khoản<i class="fa fa-user"
                                                                                         aria-hidden="true"></i></a>
        </li>
        <li><a href="{{route('trash.index')}}" style="background-color: #222">Thùng rác<i class="fa fa-trash"
                                                                                          aria-hidden="true"></i></a>
        </li>
    </ul>
</div>


