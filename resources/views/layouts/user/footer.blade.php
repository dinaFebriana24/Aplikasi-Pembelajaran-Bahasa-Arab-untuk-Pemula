            </div>
        </div>
        <!-- Footer -->
        <footer class="text-center text-lg-start bg-light text-muted">
            <!-- Copyright -->
            <div class="text-center p-4 footer text-white">
                © <span id="year"></span> Copyright 
                <a class="text-reset fw-bold" href="#">Belajar Bahasa Arab</a>
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->
        @yield('javascript')
        <script>
            document.getElementById("year").innerHTML = new Date().getFullYear();
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>