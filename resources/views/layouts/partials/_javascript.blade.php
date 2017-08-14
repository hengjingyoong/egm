<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Toastr Notifications -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
@if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";

    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}", "{{ Session::get('title') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}", "{{ Session::get('title') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}", "{{ Session::get('title') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}", "{{ Session::get('title') }}");
            break;
    }
@endif
</script>

@yield('scripts')