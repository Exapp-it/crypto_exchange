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
        trade: {
            sell: "{{ route('trade.sell.process') }}",
            buy: "{{ route('trade.buy.process') }}",
            buyOrders: "{{ route('trade.buy.orders') }}",
        }
    }
</script>
