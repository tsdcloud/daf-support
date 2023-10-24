<div>
    <form method="POST" id="frc_form" action={{ route('return_to_cash_sheet.store') }} enctype="multipart/form-data">
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


          <div class="col-md-12">
            <div class="row">
                <div class="form-group col-md-6" id="reference_fd_original">
                    <label for="reference_fd_original">Référence  fiche de dépense originelle :</label>
                    <select name="fiche_depense_id" id="fiche_depense_id" class="form-control select2" class="form-control @error('fiche_depense_id')
                    is-invalid
                    @enderror" required>
                        @foreach ($fiche_depenses as $fiche_depense)
                            <option value="{{ $fiche_depense->id }}">{{ $fiche_depense->num_comptable }}</option>
                        @endforeach
                    </select>
                    @error('fiche_depense_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>


                <div class="form-group col-md-6" id="num_dossier">
                    <label for="num_dossier">Numéro de dossier :</label>
                    <input type="text" name="num_dossier" value="{{ @old('num_dossier') }}" placeholder="numéro de dossier" class="form-control @error('num_dossier')
                    is-invalid
                    @enderror">
                    @error('num_dossier')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div>
            </div>
        </div>
            <div class="row">
                  <div class="col-md-6">
                      <div class="row">
                          <div class="form-group col-md-6">
                              <label for="retourneur">Retourneur <span class="text-danger" >*</span></label>
                              <select name="retourneur" id="retourneur" class="form-control @error('retourneur')
                                  is-invalid
                              @enderror select2" style="width: 100%;" required>
                                  <option selected="selected" disabled>Saisir son nom - Email</option>
                                  @foreach ($users as $user)
                                      <option value="{{ $user->id }}"  @selected(old('retourneur') == $user->id)>{{ $user->fname }} {{ $user->lname }} - {{ $user->email }}</option>
                                  @endforeach
                              </select>
                              @error('retourneur')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                          <div class="form-group col-md-6" id="numero_contribuable">
                              <label for="numero_contribuable">Numéro contribuable :</label>
                              <input type="number" class="form-control @error('numero_contribuable')
                              is-invalid
                              @enderror" name="numero_contribuable" value="{{ @old('numero_contribuable') }}" placeholder="saisir ici!">
                              @error('numero_contribuable')
                              <span class="text-danger">{{ $message }}</span>
                              @enderror
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <livewire:input-frc-mountain />
                  </div>

                  {{-- libellé fiche retour caisse --}}

                  <fieldset class="px-3 mx-2 border col-md-12" id="dynamicAddRemove">
                    <legend class="w-auto px-2 h6 text-primary text-sm-center text-md-left text-bold" style="font-size: 1.025em">Contenu de La DMD</legend>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="libelle">Libellé <span class="text-danger">*</span></label>
                            <input  wire:key="libelle" type="text" wire:model="libelle" placeholder="Libellé" class="form-control @error('libelle')
                            is-invalid
                            @enderror"/>
                            @error("libelle")
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="dossier">Dossier d'affectation <span class="text-danger">*</span></label>
                            <input  wire:key="dossier" type="text" wire:model="dossier" placeholder="Entrer le dossier d'affectation" class="form-control @error('dossier')
                            is-invalid
                            @enderror"/>
                            @error("dossier")
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="montant">Montant<span class="text-danger">*</span></label>
                            <input  wire:key="montant" type="number" wire:model="montant"  placeholder="Entrer le montant" class="form-control @error('montant')
                            is-invalid
                            @enderror"/>
                            @error('montant')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-3 col-md-3 form-group mt-md-0">
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
                                    <td style="width: 16%!important">{{ $datas['dossier'] }}</td>
                                    <td style="width: 16%!important">{{ $datas['montant'] }}</td>
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
                                    <th>Désignation</th>
                                    <th>Quantité</th>
                                    <th>Motif(s)</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            @endif
                        </tfoot>
                    </table>
                </fieldset>

            </div>
        </div><!-- /.card-body -->
        <div class="row">
          <div class="form-group col-md-6">
              <label for="filenames">Pièces jointes</label>
              <input type="file" name="filenames[]" multiple id="filenames" class="@error('filenames.*') is-invalid @enderror form-control" style="width: 100%;">
              @error('filenames.*')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
      </div>

        <div class="card-footer">
            <button type="submit" id="register" class="btn btn-primary">Soumettre</button>
        </div>
    </form>
</div>
