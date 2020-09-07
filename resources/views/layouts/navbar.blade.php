<nav class="navbar navbar-expand-sm navbar-light" style="background:#FFCC00;	">
  <div class="header-left">
    <a href="/" class="navbar-brand">
      <img src="{{url('images/header-logo.png')}}" style="width:30px; height:30px;">
    </a>
    <div class="header-title">
      <p>筋トレコミュニティ</p>
      <h1><a href="/">Muscle +</a></h1>
    </div>
  </div>


  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#responsiveMenu" aria-controls="responsiveMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="responsiveMenu">
        <ul class="navbar-nav ml-auto">
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{route('login.guest')}}">かんたんログイン</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('register')}}">新規登録</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('login')}}">ログイン</a>
            </li>
            @endguest

            @auth
              <li class="nav-item">
                  <a class="nav-link" href="/home">ホーム</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{route('posts.new')}}">記録する</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{route('users.show' , ['user' => Auth::user()])}}">プロフィール</a>
              </li>
            @endauth
        </ul>
    </div>



</nav>
