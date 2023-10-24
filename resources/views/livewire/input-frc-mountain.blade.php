<div wire:poll class="row">
    <div class="form-group col-md-6">
        <label for="montant">
            Montant initiale en :
            <span>{{ $inputValue['montant'] ? '('.number_format($inputValue['montant'], 0, ',', '.') . ')' :''}}</span>
        </label>
        <input type="number" value="{{ @old('montant') }}" class="form-control @error('montant') is-invalid @enderror" wire:model="inputValue.montant" name="montant" id="montant_fd" placeholder="Montant">
        @error('montant')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>


    <div class="form-group col-md-6">
        <label for="reliquat">
            Reliquat en :
            <span>{{ $inputValue['reliquat'] ? '('.number_format($inputValue['reliquat'], 0, ',', '.') . ')' :''}}</span>
        </label>
        <input type="number"  value="{{ @old('reliquat') }}" class="form-control @error('reliquat') is-invalid @enderror" wire:model="inputValue.reliquat" name="reliquat" id="reliquat" placeholder="reliquat">
        @error('reliquat')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
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
