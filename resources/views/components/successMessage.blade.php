@if (session('success'))
    <div id="successMessage" class="alert alert-success text-center bg-green-300 text-white">
        {{ session('success') }}
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('successMessage').style.display = 'none';
        }, 3000);
    </script>
@endif
