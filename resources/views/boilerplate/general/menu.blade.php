<nav class="navbar navbar-inverse navbar-fixed-top menu">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <div class="menu__logo-container">
                <a href="#">{!! file_get_contents('images/logo.svg')!!}</a>
            </div>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right menu__link">
                <li><a href="#">Admin</a></li>
                <li><a href="#">Ver Sitio</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
