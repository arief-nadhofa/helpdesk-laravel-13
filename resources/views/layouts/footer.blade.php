    </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2-laravel').select2({
                placeholder: "Cari nama user...",
                allowClear: true,
                width: '100%' // Pastikan mengambil lebar penuh kontainer Tailwind
            });
        });
    </script>

    </body>

    </html>