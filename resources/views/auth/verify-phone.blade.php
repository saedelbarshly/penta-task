<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Thanks for signing up! Before getting started, verify code has been sent to you in your phone number.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form>
            <div class="alert alert-danger" id="error" style="display: none;"></div>
            <div class="alert alert-success" id="successRegsiter" style="display: none;"></div>
            <div>
                <x-input-label for="code" :value="__('Code')" />
                <x-text-input id="code" class="block mt-1 mb-2 w-full" type="text"
                    placeholder="Enter verification code" />
            </div>
            <button type="button" class="btn btn-success" onclick="codeverify();">Verify code</button>

        </form>

    </div>

    @section('js')
    <script>
        function codeverify() {
            let code = $("#code").val();
            let storedCoderesult = JSON.parse(localStorage.getItem('coderesult'));
            if (storedCoderesult) {
                storedCoderesult.confirm(code).then(function() {
                    $("#successRegister").text("You are registered successfully.");
                    $("#successRegister").show();
                    setTimeout(function() {
                        $("#successRegister").hide();
                        window.location.href = "{{ route('login') }}";
                    }, 3000);
                }).catch(function(error) {
                    $("#error").text("Invalid Code");
                    $("#error").show();
                    setTimeout(function() {
                        $("#error").hide();
                    }, 3000);
                });
            } else {
                console.error("No coderesult found in localStorage.");
            }
        }
    </script>
    
    @endsection
</x-guest-layout>
