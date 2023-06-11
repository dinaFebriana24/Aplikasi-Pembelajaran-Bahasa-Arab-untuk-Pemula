function openNav() {
    sidebar = document.getElementById("mySidebar");
    main = document.getElementById("main");
    if(sidebar.classList.contains('sidebar-open')) {
        sidebar.classList.remove('sidebar-open');
        main.classList.remove('main-open');
    } else {
        sidebar.classList.add('sidebar-open');
        main.classList.add('main-open');
    }
}