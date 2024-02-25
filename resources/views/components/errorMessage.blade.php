@if (session('error'))
    <div id="errorMessage" class="alert alert-success text-center bg-red-300 text-white">
        {{ session('error') }}
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('errorMessage').style.display = 'none';
        }, 3000);
    </script>
@endif
