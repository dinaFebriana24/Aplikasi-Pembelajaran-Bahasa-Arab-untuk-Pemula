<style>
.mainCategory {
    margin: 0;
    max-height: 0px;
    overflow: hidden;
    transition: max-height 200ms ease-out;
}

.mainCategory.ul-show{
    transition: max-height 200ms ease-in;
    max-height: 400px;
}

.mainCategory > li > a {
  text-decoration: none;
  color: #fff;
}
</style>

<div id="mySidebar" class="sidebar sidebar-open overflow-y-auto">
    <a class="logo" href="/home">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" height="40" class="d-inline-block align-text-top">
    </a>
    <a href="/home" class="sidebar-link sidebar-link-first">Dashboard</a>
    @if(Auth::user()->level == "admin")
        <p>Admin Menu</p>
        <hr>
        <a href="/admin/mainkategori" class="sidebar-link">Main Kategori</a>
        <a href="/admin/kategori" class="sidebar-link">Kategori</a>
        <a href="/admin/materi" class="sidebar-link">Materi</a>
        <a href="/admin/kuis" class="sidebar-link">Kuis</a> 
    @endif

    @foreach ($main_categories as $main_category) 
        <a class="nav-link dropdown-toggle sidebar-link" data-ulid="mainCategory{{$main_category->id}}" onclick="toggleDropdownItem(this);" href="#">
            <i class='bx bx-news nav_icon'></i>
            <span class="nav_name">{{ $main_category -> name }}</span>
        </a>            
                    <ul class="mainCategory" id="mainCategory{{$main_category->id}}">
                        @foreach($categories as $category)
                            @if($category->main_category_id == $main_category->id)
                                <li class="nav-link sidebar-link">  
                                    <a href="/{{ $category->name }}" class="nav_link">
                                        <i class='bx bx-grid-alt nav_icon'></i>
                                            <span class="nav_name">{{ $category->name }}</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                        <li class="nav-link sidebar-link"> 
                            <a href="/{{ $main_category->name }}/quiz" class="nav_link">
                                <i class='bx bx-grid-alt nav_icon'></i>
                                      <span class="nav_name">Kuis</span>
                            </a>    
                        </li>  
                    </ul>
    @endforeach

</div>