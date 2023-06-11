        </div>
    </div>

    @yield('javascript')
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
                function toggleDropdownItem(element){
                    document.getElementById(element.dataset.ulid).classList.toggle("ul-show");
                }
    </script>
  </body>
</html>