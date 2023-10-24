<div>
    <fieldset class="px-3 mx-2 border col-md-12" id="dynamicAddRemove">
        <legend class="w-auto px-2 h6 text-primary text-sm-center text-md-left text-bold" style="font-size: 1.025em">Libellé de la recette</legend>
        <div class="row">
            <div class="col-md-2">
                <label for="libelle">Libellé<span class="text-danger">*</span></label>
                <input type="text" name="addMoreInput[0][libelle]" value="{{ @old('addMoreInput[0][libelle]') }}" placeholder="Entrer le libellé" class="form-control @error('addMoreInput.*.libelle')
                is-invalid
                @enderror" required/>
                @error('addMoreInput.*.libelle')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-2">
                <label for="prix_unitaire">Prix unitaire XAF<span class="text-danger">*</span></label>
                <input type="number" name="addMoreInput[0][prix_unitaire]" value="{{ @old('addMoreInput[0][prix_unitaire]') }}" placeholder="Entrer le prix unitaire" class="form-control @error('addMoreInput.*.prix_unitaire')
                is-invalid
                @enderror" required/>
                @error('addMoreInput.*.prix_unitaire')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-2">
                <label for="quantite">Quantité<span class="text-danger">*</span></label>
                <input type="number" name="addMoreInput[0][quantite]" value="{{ @old('addMoreInput[0][quantite]') }}" placeholder="Entrer la quantité" class="form-control @error('addMoreInput.*.quantite')
                is-invalid
                @enderror" required/>
                @error('addMoreInput.*.quantite')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-2">
                <label for="dossier">Dossier d'affectation<span class="text-danger">*</span></label>
                <input type="text" name="addMoreInput[0][dossier]" placeholder="Entrer un dossier" class="form-control @error('addMoreInput.*.dossier')
                is-invalid
                @enderror" required/>
                @error('addMoreInput.*.dossier')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-2">
                <label for="prix_total">Prix total XAF<span class="text-danger">*</span></label>
                <input type="number" name="addMoreInput[0][site_prod]" value="{{ @old('addMoreInput[0][prix_total]') }}" placeholder="Site de production" class="form-control @error('addMoreInput.*.prix_total')
                is-invalid
                @enderror" required/>
                @error('addMoreInput.*.prix_total')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-2 col-md-2 form-group mt-md-0">
                <label for="montan" class="text-white d-none d-sm-none d-md-block">
                      montant
                </label>
                <button wire:click="store" type="button" name="add" class="btn btn-primary w-100 ">
                    <i class="fa fa-plus-circle"></i>
                    Ajouter
                </button>
            </div>
        </div>
    </fieldset>
</div>
