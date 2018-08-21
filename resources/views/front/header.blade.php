<!-- pc 顶部 -->
<div class="head-pc-wrap">
    <div class="head-pc">
        <h1 class="logo"><img src="/img/logo.png"></h1>
        <div class="head-r">
            <div class="head-r-top">
                <p>{{trans('head.welcome')}}</p>
                @if(Session::has('User_Session') && Session::get('User_Session')->mobile_phone!=="")
                    <p>
                        <span>{{ Session::get('User_Session')->mobile_phone }}</span>
                    </p>
                @endif
                <p>
                    <span onclick="setLocal('zh-CN')">中</span> /
                    <span onclick="setLocal('zh-TW')">繁</span>/
                    <span onclick="setLocal('en')">EN</span>/
                    <span onclick="setLocal('ja')">JP</span>/
                    <span onclick="setLocal('ko')">KO</span>/
                </p>
            </div>
            <div class="head-r-bottom">
                <a href="/cec/index#">{{trans('head.home')}}</a>
                <a href="/cec/index#eceIntro">{{trans('head.about')}}</a>
                <a href="/cec/index#intel">{{trans('head.union')}}</a>
                {{--<a href="javascript:void(0)">新闻动态</a>--}}
                <a href="/cec/index#whitePaper">{{trans('head.whitepaper')}}</a>
                <a href="/cec/index#about">{{trans('head.contact')}}</a>
                @if(Session::has('User_Session')  && Session::get('User_Session')->mobile_phone!=="")
                    <a href="/cec/userindex">{{trans('head.usercenter')}}</a>
                    <a href="/cec/loginout">{{trans('head.signout')}}</a>
                @else
                    <a href="/cec/login">{{trans('head.register')}}/{{trans('head.login')}}</a>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="m-head box-border">
    <h1 class="logo">
        <img src="/img/logo.png">
    </h1>
    <span class="home" id="home">
      <img src="/img/home.jpg">
    </span>
</div>
<div class="m-menu-wrap" id="m-menu">
    <div class="m-menu">
        <a href="/cec/index#">{{trans('head.home')}}</a>
        <a href="/cec/index#eceIntro">{{trans('head.about')}}</a>
        <a href="/cec/index#intel">{{trans('head.union')}}</a>
        {{--<a href="javascript:void(0)">新闻动态</a>--}}
        <a href="/cec/index#whitePaper">{{trans('head.whitepaper')}}</a>
        <a href="/cec/index#about">{{trans('head.contact')}}</a>
        @if(Session::has('User_Session') && Session::get('User_Session')->mobile_phone!=="")
            <a href="/cec/userindex">{{trans('head.usercenter')}}</a>
            <a href="/cec/loginout">{{trans('head.signout')}}</a>
        @else
            <a href="/cec/login">{{trans('head.register')}}/{{trans('head.login')}}</a>
        @endif

        <a href="#" onclick="setLocal('zh-CN')">简体中文</a>
        <a href="#" onclick="setLocal('zh-TW')">繁體中文 </a>
        <a href="#" onclick="setLocal('en')">English</a>
        <a href="#" onclick="setLocal('ja')">Japanese</a>
        <a href="#" onclick="setLocal('ko')">Korean</a>

    </div>
</div>