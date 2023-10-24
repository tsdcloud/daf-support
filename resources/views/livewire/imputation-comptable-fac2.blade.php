<div>
    <form action="{{ route('add.num_comptable', $fiche_approv_caisse->id) }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="form-body">
                <div class="row">

                    <div class="form-group col-md-4">
                        <label for="num_facture">N° de Facture</label>
                        <input type="text" name="num_facture" id="num_facture" value="{{ @old('num_facture') }}" class="form-control  @error('num_facture') is-invalid @enderror" placeholder="N° facture">
                        @error('num_facture')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="num_compte_general">N° Compte général <span class="text-danger"><sup>*</sup></span></label>
                        <input type="number" name="num_compte_general" id="num_compte_general" value="{{ @old('num_compte_general') }}" class="form-control  @error('num_compte_general') is-invalid @enderror" placeholder="N° compte général" required>
                        {{-- <input type="text" name="num_comptable" wire:change="checkNumComptableValidation()" wire:model="imputation_comptable.num_comptable" id="num_comptable" value="{{ @old('num_comptable') }}" class="form-control  @error('num_comptable') is-invalid @enderror" placeholder="8 chiffre complet par 0" required> --}}
                        @error('num_compte_general')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <div class="form-group col-md-4">
                        <label for="code_tiers">Code tiers <span class="text-danger"><sup>*</sup></span></label>
                        <input type="text" name="code_tiers" id="code_tiers" value="{{ @old('code_tiers') }}" class="form-control  @error('code_tiers') is-invalid @enderror" placeholder="Insérer le code tiers" required>
                        {{-- <input type="text" name="code_tiers" wire:change="checkCodeTiersValidation()" wire:model="imputation_comptable.code_tiers" id="code_tiers" value="{{ @old('code_tiers') }}" class="form-control  @error('code_tiers') is-invalid @enderror" placeholder="4 chiffres et 10 lettres max" required> --}}
                        @error('imputation_comptable.code_tiers')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @error('code_tiers')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                </div>

                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="section_analytique_input">Section analytique <span class="text-danger"><sup>*</sup></span></label>
                        <input type="text" id="section_analytique_input" value="{{ $fiche_approv_caisse->num_dossier }}" class="form-control  @error('section_analytique') is-invalid @enderror" placeholder="Section analytique" required disabled>
                        {{-- <input type="text" name="section_analytique" wire:change="checkValidation()" wire:model="imputation_comptable.section_analytique" id="section_analytique" value="{{ @old('section_analytique') }}" class="form-control  @error('section_analytique') is-invalid @enderror" placeholder="12 Digits max" required> --}}
                        @error('imputation_comptable.section_analytique')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @error('section_analytique')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ref_compte">Référence compte <span class="text-danger"><sub>*</sub></span></label>
                        <select name="ref_compte" id="ref_compte" class="form-control  @error('ref_compte') is-invalid @enderror" required>
                            @foreach ($comptes as $compte)
                                <option value="{{ $compte->id }}" @selected(old('ref_compte') == $compte->id)>{{ $compte->banque }} {{ $compte->intitule }}</option>
                            @endforeach
                        </select>
                        {{-- <input type="text" name="ref_compte" id="ref_compte" value="{{ @old('ref_compte') }}" class="form-control  @error('ref_compte') is-invalid @enderror" placeholder="Zonne de liste" required> --}}
                        @error('ref_compte')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="num_cheque_virement">N° Chèque/Virement </label>
                        <input type="number" name="num_cheque_virement" id="num_cheque_virement" value="{{ @old('num_cheque_virement') }}" class="form-control  @error('num_cheque_virement') is-invalid @enderror" placeholder="Numéro de compte">
                        @error('num_cheque_virement')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label for="montant_dette">Montant dette</label>
                        <input type="number" name="montant_dette" id="montant_dette" value="{{ @old('montant_dette') }}" class="form-control  @error('montant_dette') is-invalid @enderror" placeholder="saisir montant dette">
                        @error('montant_dette')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="montant_a_payer_input">Montant payé</label>
                        <input type="text" id="montant_a_payer_input" value="{{ \App\Helpers\MoneyHelper::price($fiche_approv_caisse->montant) }}" class="form-control  @error('montant_a_payer_input') is-invalid @enderror" disabled>
                        <input type="number" id="montant_a_payer_input" value="{{ \App\Helpers\MoneyHelper::price($fiche_approv_caisse->montant) }}" class="form-control  @error('montant_a_payer_input') is-invalid @enderror d-none">
                        @error('montant_a_payer_input')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="retenu_source">Retenue à la source</label>
                        <input type="number" name="retenu_source" id="retenu_source" value="{{ @old('retenu_source') }}" class="form-control  @error('retenu_source') is-invalid @enderror" placeholder="Retenue à la source">
                        @error('retenu_source')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="num_attestation">N° Attestation</label>
                        <input type="text" name="num_attestation" id="num_attestation" value="{{ @old('num_attestation') }}" class="form-control  @error('num_attestation') is-invalid @enderror" placeholder="N° attestation">
                        @error('num_attestation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="num_comptable">Référence comptable <span class="text-danger"><sup>*</sup></span></label>
                        <input type="text" id="num_comptable" name="num_comptable" class="form-control  @error('num_comptable') is-invalid @enderror" placeholder="Numéro comptable">
                        @error('num_comptable')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- fin élément comptable --}}
                <div class="modal-footer" style="margin-left: -15px!important;margin-right: -15px!important">
                    <div class="row w-100" style="margin-left: -15px!important;margin-right: -15px!important">
                        <div class="col-md-6" style="margin-left: -20px!important">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                        </div>
                        <div class="col-md-6" style="margin-right: -20px!important">
                            <button type="submit" class="btn btn-primary float-right">Enregistrer</button>
                        </div>
                    </div>
                    {{-- @if ($display_submit_btn)
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    @endif --}}
                </div>
            </div>
        </div>
    </form>

</div>
