<nav class="nav">
    <div class="nav-left">
        <a class="nav-item is-brand" href="#">
            {{Voyager::setting('title')}}
        </a>
    </div>

    <div class="nav-center">
        <a class="nav-item" href="#">
      <span class="icon">
        <i class="fa fa-github"></i>
      </span>
        </a>
        <a class="nav-item" href="#">
      <span class="icon">
        <i class="fa fa-twitter"></i>
      </span>
        </a>
    </div>

    <span class="nav-toggle" id="nav-toggle">
    <span></span>
    <span></span>
    <span></span>
  </span>

    <div class="nav-right nav-menu" id="nav-menu">
        {!! Menu::display('web', 'layouts.menu.items') !!}
        <span class="nav-item">
    </span>
    </div>
</nav>