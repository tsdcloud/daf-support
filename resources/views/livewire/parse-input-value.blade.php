<div wire:poll>
    <label for="montant">
        Montant XAF <span class="text-danger" >*</span>
        <span>{{ $inputValue ? '('.number_format($inputValue, 0, ',', '.') . ')' :''}}</span>
    </label>

    <input type="number" class="form-control @error('montant') is-invalid @enderror" wire:model="inputValue" min="0" name="montant" id="montant_fd" placeholder="Montant">
    @push('scripts')
        <script>
            function numStr(a, b) {
                a = '' + a;
                b = b || ' ';
                var c = '',
                d = 0;
                while (a.match(/^0[0-9]/)) {
                    a = a.substr(1);
                }
                for (var i = a.length-1; i >= 0; i--) {
                    c = (d != 0 && d % 3 == 0) ? a[i] + b + c : a[i] + c;
                    d++;
                }
                return c;
            }

            // const input = document.querySelector('input');
            var input = document.getElementById('montant_fd');
            // alert(input.value);
            input.addEventListener('change', function(){
                input.value = numStr(input.value,'.');
                console.log(numStr(input.value,'.'));
            });

            function updateValue(e) {
                // input.value = e.target.value;
                // alert
                // input.style.color = 'red';
            }

        </script>
    @endpush
</div>
