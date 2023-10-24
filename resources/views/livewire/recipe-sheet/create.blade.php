<div>
    {{-- Success is as dangerous as failure. --}}
    <form wire:submit.prevent="submitData" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div wire:ignore.self class="form-group col-md-6">
                    <label for="city_entity_id">
                        Sélectionner votre ville<span class="text-danger" >*</span>
                        {{-- @dump($city_entity_id) --}}
                    </label>
                    <select wire:model="city_entity_id" id="city_entity_id" class="@error('city_entity_id') is-invalid @enderror form-control" style="width: 100%;" data-select2-id="17" tabindex="-1" step='100' aria-hidden="true" required>
                        <option selected="selected">Choisir la ville </option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->pivot->id }}">
                                {{ $city->label }} {{ $city->loop }}
                            </option>
                        @endforeach
                    </select>
                    @error('city_entity_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div wire:ignore.self class="form-group col-md-6">
                    <label for="site_id">
                        Sélectionner votre site<span class="text-danger" >*</span></label>
                    <select wire:model="site_id" id="site_id" class="@error('site_id') is-invalid @enderror form-control" style="width: 100%;" data-select2-id="17" tabindex="-1" step='100' aria-hidden="true" required>
                        <option selected="selected">Choisir le site</option>
                        @foreach ($sites as $site)
                            <option value="{{ $site->id }}">
                                {{ $site->label }}
                            </option>
                        @endforeach
                    </select>
                    @error('site_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        <label>Apporteur<span class="text-danger" >*</span></label>
                        <input class="form-control" type="text" placeholder="Entrer le nom..." wire:model.debounce.500ms="user_name" required/>

                        <div wire:loading.flex wire:target="user_name">
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border" role="status"></div>
                            </div>
                        </div>
                        <div class="absolute z-10 mt-1 w-full text-sm overflow-auto px-2" wire:loading.remove>
                            <ul class="list-group">
                                @if (empty($users) && $user_name != '')
                                    pas de resultat
                                @else
                                    @if (!empty($users) && $user_name != '')
                                        @foreach ($users as $i => $user)
                                            <a href="javascript:void(0)"
                                                wire:click="selectUser({{ $i }})"
                                                class="list-group-item list-group-item-action"
                                                {{ $hiddenUser }}>{{ $user['fname'].'-'.$user['lname'].'  '.'email : '.$user['email'] }}
                                            </a>
                                        @endforeach
                                    @endif
                                @endif
                            </ul>
                        </div>
                        @error('user_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>



                {{-- <div class="form-group col-md-6">
                    <label for="apporteur">Apporteur<span class="text-danger" >*</span></label>
                    <select wire:model="apporteur" id="apporteur" class="form-control select2 @error('apporteur')
                        is-invalid  @enderror " style="width: 100%;" >



                    </select>
                    @error('apporteur')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}

                <div class="form-group col-md-6">
                    <label for="controlleur">Contrôleur <span class="text-danger" >*</span></label>
                    <select wire:model="controlleur" id="controlleur" class="form-control select2 @error('controlleur')
                        is-invalid  @enderror " style="width: 100%;" required>
                        <option selected="selected" >Saisir son nom - Email</option>
                        @foreach ($controlleurs as $controlleur)
                            <option value="{{ $controlleur->id }}" >{{ $controlleur->fname }} {{ $controlleur->lname }} - {{ $controlleur->email }}</option>
                        @endforeach
                    </select>
                    @error('controlleur')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div wire:ignore class="form-group col-md-6" id="raison_sociale">
                    <label for="raison_sociale">Raison sociale</label>
                    <input  wire:model="raisonSociale" type="text" class="form-control @error('raisonSociale')
                    is-invalid
                    @enderror" placeholder="Raison sociale">
                    @error('raisonSociale')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div wire:ignore class="form-group col-md-6" id="numeroContribuable">
                    <label for="numeroContribuable">Numéro contribuable</label>
                    <input type="texte" class="form-control @error('numeroContribuable')
                    is-invalid
                    @enderror" wire:model="numeroContribuable" placeholder="saisir ici!">
                    @error('numeroContribuable')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Contact -->
                <div wire:ignore class="form-group col-md-6" id="contact">
                    <label for="contact">Contact</label>
                    <input type="text" class="form-control @error('contact')
                    is-invalid
                    @enderror" wire:model="contact" placeholder="contact">
                    @error('contact')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Provenance recette -->
                <div wire:ignore class="form-group col-md-6">
                    <label for="provenance">Provenance de la recette<span class="text-danger">*</span></label>
                    <select wire:model="provenance" id="provenance"  class="@error('provenance')
                        is-invalid @enderror form-control select2" required >
                        <option value="" @if (old('provenance') == "") {{ 'selected' }} @endif >Séléctionnez une provenance de la recette</option>
                        <option value="règlement de facture" @if (old('provenance') == "règlement de facture") {{ 'selected' }} @endif >Règlement de facture</option>
                        <option value="caution sur opération" @if (old('provenance') == "caution sur opération") {{ 'selected' }} @endif>Caution sur opération</option>
                        <option value="vente sur site" @if (old('provenance') == "vente sur site") {{ 'selected' }} @endif>Vente sur site</option>
                        <option value="déposit client" @if (old('provenance') == "déposit client") {{ 'selected' }} @endif>Déposit client</option>
                        {{-- <option value="paiement pont bascule" @if (old('provenance') == "paiement pont bascule") {{ 'selected' }} @endif>Paiement pont bascule</option> --}}

                    </select>
                    @error('provenance')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!--  mode de paiment -->
                <div wire:ignore class="form-group col-md-6">
                    <label for="modePaiment">Mode de paiement<span class="text-danger">*</span></label>
                    <select  wire:model="modePaiment" id="modePaiment"  class="@error('modePaiment')
                    is-invalid @enderror form-control select2" required >
                        <option value="" @if (old('modePaiment') == "") {{ 'selected' }} @endif >Séléctionnez un mode de paiement</option>
                        <option value="espèces" @if (old('modePaiment') == "espèces") {{ 'selected' }} @endif >Espèces</option>
                        <option value="paiement mobile" @if (old('modePaiment') == "paiement mobile") {{ 'selected' }} @endif >Paiement mobile</option>
                        <option value="chèque bancaire" @if (old('modePaiment') == "chèque bancaire") {{ 'selected' }} @endif >Chèque bancaire</option>
                        <option value="virement bancaire" @if (old('modePaiment') == "virement bancaire") {{ 'selected' }} @endif >Virement bancaire</option>
                        <option value="carte bancaire" @if (old('modePaiment') == "carte bancaire") {{ 'selected' }} @endif >carte bancaire</option>

                    </select>
                    @error('modePaiment')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div wire:ignore class="form-group col-md-6">
                    <label for="shift">Tranche horaire</label>
                    <select wire:model="shift" id="shift"  class="@error('shift')
                        is-invalid @enderror form-control select2"  >
                        <option value="" @if (old('shift') == "") {{ 'selected' }} @endif >Séléctionner une tranche horaire</option>
                        <option value="6h15 - 14h15" @if (old('shift') == "6h15 - 14h15") {{ 'selected' }} @endif >6h15 - 14h15</option>
                        <option value="14h15 - 22h15" @if (old('shift') == "14h15 - 22h15") {{ 'selected' }} @endif>14h15 - 22h15</option>
                        <option value="22h15 - 6h15" @if (old('shift') == "22h15 - 6h15") {{ 'selected' }} @endif>22h15 - 6h15</option>

                    </select>
                    @error('shift')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- pièces jointe -->
                {{-- <div wire:ignore class="form-group col-md-6">
                    <label for="filenames">Pièces jointes</label>
                    <input type="file" wire:model="filenames" multiple id="filenames" class="@error('filenames.*') is-invalid @enderror form-control" style="width: 100%;">
                    @error('filenames.*')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}

                <!-- Montant global percu -->
                <div wire:ignore class="form-group col-md-12">
                    <label for="prixTotalGlobal">Total perçu</label>
                    <input type="number" step="0.1" wire:model="prixTotalGlobal" class="@error('prixTotalGlobal') is-invalid @enderror form-control" style="width: 100%;" disabled>
                    @error('prixTotalGlobal')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>

                <fieldset class="px-3 mx-2 border col-md-12" id="dynamicAddRemove">
                    <legend class="w-auto px-2 h6 text-primary text-sm-center text-md-left text-bold" style="font-size: 1.025em">Libellé de la recette</legend>
                    <div class="row">
                        {{-- {{ dd($produces) }} --}}

                        <div class="col-md-2">
                            <label for="libelle">Libellé <span class="text-danger"><sub>*</sub></span></label>
                            <select wire:model="libelle_id" name="libelle" id="ref_compte" class="form-control  @error('libelle') is-invalid @enderror" >
                                <option value="" @if (old('libelle') == "") {{ 'selected' }} @endif >Séléctionner un produit</option>
                                @foreach ($produces as $produce)
                                    <option value="{{ $produce->id }}" @selected(old('libelle') == $produce->id)>{{ $produce->label }}</option>
                                @endforeach
                            </select>
                            @error('libelle_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- <div class="col-md-2">
                            <label for="libelle">Libellé <span class="text-danger">*</span></label>
                            <input  wire:key="libelle" type="text" wire:model="libelle" placeholder="Entrer le libellé" class="form-control @error('libelle')
                            is-invalid
                            @enderror"/>
                            @error("libelle")
                                <span>{{ $message }}</span>
                            @enderror
                        </div> --}}

                        <div class="col-md-2">
                            <label for="prixUnitaire">Prix unitaire <span class="text-danger">*</span></label>
                            {{-- <input type="number" wire:ignore.self wire:model.defer="prixUnitaire" placeholder="Entrer le prix unitaire" class="form-control @error('prixUnitaire') --}}
                            <input  wire:key="prixUnitaire" type="number" wire:model="prixUnitaire" placeholder="Entrer le prix unitaire" class="form-control @error('prixUnitaire')
                            is-invalid
                            @enderror"disabled/>
                            @error('prixUnitaire')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label for="quantite">Quantité<span class="text-danger">*</span></label>
                            {{-- <input type="number" wire:ignore.self wire:model.defer="quantite" placeholder="Entrer la quantité" class="form-control @error('quantite') --}}
                            <input  wire:key="quantite" type="number" wire:model="quantite"  placeholder="Entrer la quantité" class="form-control @error('quantite')
                            is-invalid
                            @enderror"/>
                            @error('quantite')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label for="dossier">Dossier d'affectation</label>
                            <input  wire:key="dossier" type="text" wire:model="dossier" placeholder="Entrer un dossier" class="form-control @error('dossier')
                            is-invalid
                            @enderror"/>
                            @error("dossier")
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label for="prix_total">Prix total<span class="text-danger">*</span></label>
                            <input  wire:key="prixTotal" type="number" wire:model="prixTotal" placeholder="Prix total" class="form-control @error('prixTotal')
                            is-invalid
                            @enderror" disabled/>
                            @error("prixTotal")
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-2 col-md-2 form-group mt-md-0">
                            <label for="montant" class="text-white d-none d-sm-none d-md-block">
                                montant
                            </label>
                            <button wire:loading wire:target="addRowData" class="btn btn-primary w-100" type="button" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Chargement...
                            </button>
                            <button wire:click="addRowData" wire:loading.remove type="button" name="add" class="btn btn-primary w-100 ">
                                <i class="fa fa-plus-circle"></i>
                                Ajouter
                            </button>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-reponsive">
                        <tbody>

                            @foreach ($arrayData as $key => $datas)
                                <tr>
                                    <td style="width: 16%!important">{{ $datas['libelle'] }}</td>
                                    <td style="width: 16%!important">{{ $datas['prixUnitaire'] }}</td>
                                    <td style="width: 16%!important">{{ $datas['quantite'] }}</td>
                                    <td style="width: 16%!important">{{ $datas['dossier'] }}</td>
                                    <td style="width: 16%!important">{{ $datas['prixTotal'] }}</td>
                                    <td style="width: 18%!important" class="text-center">
                                        <a wire:click="editRowData({{ $key }})" class="btn btn-success">
                                            <i class="fa fa-edit"></i> Mod.
                                        </a>
                                        <a wire:click="removeRowData({{ $key }})" class="btn btn-danger">
                                            <i class="fa fa-trash-alt"></i> Supp.
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            @if(count($arrayData) != 0)
                                <tr>
                                    <th>Libellé</th>
                                    <th>Prix unitaire</th>
                                    <th>Quantité</th>
                                    <th>Dossier d'affectation</th>
                                    <th>Total : {{ $prixTotalGlobal }}</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            @endif
                        </tfoot>
                    </table>
                </fieldset>
            {{--  --}}
        </div>

        <div class="card-footer">
            {{-- onclick="return confirm('Avez-vous correctement rempli les champs ? si oui cliquez sur ok')" --}}
            <button wire:loading wire:target="submitData" class="btn btn-primary" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Chargement ...
              </button>
            <button  wire:loading.remove type="submit" id="register" class="btn btn-primary">
                Soumettre
            </button>
        </div>
    </form>
</div>
