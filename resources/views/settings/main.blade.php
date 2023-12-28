<script>
    const baseUrl = "{{ url('/') }}"
    const csrfToken = "{{ csrf_token() }}"
    const routes = {
        home: "{{ route('home') }}",
        login: "{{ route('auth.login') }}",
        register: "{{ route('auth.register') }}",
        forgot: "{{ route('password.email') }}",
        reset: "{{ route('password.update') }}",
        main: "{{ route('user') }}",
        order: {
            sell: "{{ route('order.sell.process') }}",
            buy: "{{ route('order.buy.process') }}",
            listByUser: "{{ route('order.buy.orders') }}",
        }
    }
</script>
