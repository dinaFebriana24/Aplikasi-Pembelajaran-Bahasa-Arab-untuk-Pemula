<div class="container mt-3 w-100 h-auto mb-3 vh-100">
    <div class="row">
        <div class="col-lg-2 col-xl-2 col-md-4">
            <div class="list-group">
                <a href="/home" class="list-group-item list-group-item-action {{ (request()->is('home')) ? 'active' : '' }}" aria-current="true">
                    Home
                </a>
                <a href="/huruf" class="list-group-item list-group-item-action {{ (request()->is('huruf')) ? 'active' : '' }}">Huruf</a>
                <a href="#" class="list-group-item list-group-item-action">A third link item</a>
                <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
                <a class="list-group-item list-group-item-action disabled">A disabled link item</a>
            </div>
        </div>