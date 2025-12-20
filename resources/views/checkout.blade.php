<div>
    <!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" 
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>

        <button id="pay-button">Bayar Sekarang</button>

        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function(){
                snap.pay('{{ $snapToken }}');
            };
        </script>
</div>
