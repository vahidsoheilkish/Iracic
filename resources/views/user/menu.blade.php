<html>
<head>
    <link rel="stylesheet" href="/css/user.css"/>
    <style>
        .menu_{
            color:#222;
            font-weight: bolder;
        }
        .submenu_{
            font-size:12px;
        }
        #menu_wrapper{display: flex; margin:10px 10px;}
        #menu_wrapper a {margin:0 10px; border:1px solid red; padding:4px;}
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            @foreach($menus as $menu)
                <div class="col-sm-12" id="menu_wrapper">
                        @php($name = json_decode($menu->name ) )
                        <a class="menu_" href="{{$menu->link}}">{{ $name->en }}
                            <img src="/upload/menu/{{$menu->img}}" style="width:40px;"/>
                        </a><br/>

                        @if($menu->submenus()->exists())
                            @foreach($menu->submenus as $submenu)
                                @php($subname = json_decode($submenu->name ) )
                                <a class="submenu_" href="{{$submenu->link}}">{{ $subname->en }}
                                    <img src="/upload/submenu/{{$submenu->img}}" style="width:20px;"/>
                                </a><br/>
                            @endforeach
                        @endif
                </div>
            @endforeach
            <div class="col-sm-12">

            </div>
        </div>
    </div>
</body>
</html>