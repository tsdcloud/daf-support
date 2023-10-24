<div>
    {{-- <form method="POST" id="dmd_form" action={{ route('availability_request_sheet.store') }} enctype="multipart/form-data"> --}}
    <form wire:submit.prevent="submitData" enctype="multipart/form-data">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="city_entity_id">
                        Selectionner votre ville<span class="text-danger" >*</span>
                        {{-- @dump($city_entity_id) --}}
                    </label>
                    <select wire:model="city_entity_id" id="city_entity_id" class="@error('city_entity_id') is-invalid @enderror select2 form-control" style="width: 100%;" data-select2-id="17" tabindex="-1" step='100' aria-hidden="true" required>
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
                <div class="form-group col-md-6">
                    <label for="site_id">
                        Selectionner votre site<span class="text-danger" >*</span></label>
                    <select wire:model="site_id" id="site_id" class="@error('site_id') is-invalid @enderror select2 form-control" style="width: 100%;" data-select2-id="17" tabindex="-1" step='100' aria-hidden="true" required>
                        <option selected="selected">Choisir le site</option>
                        @foreach ($sites as $site)
                            <option value="{{ $site->id }}">{{ $site->label }}</option>
                        @endforeach
                    </select>
                    @error('site_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">

                {{-- <div class="form-group col-md-6">
                    <label for="service_demandeur">Service demandeur<span class="text-danger" >*</span></label>
                    <select wire:model="service_demandeur" id="service_demandeur" class="form-control @error('service_demandeur')
                        is-invalid
                    @enderror select2" style="width: 100%;" required>
                        <option selected="selected" disabled>Choisir le service</option>
                        @foreach ($service_demandeurs as $service_demandeur)
                            <option value="{{ $service_demandeur->id }}"  @selected(old('service_demandeur') == $service_demandeur->id)>{{ $service_demandeur->title }} ({{ $service_demandeur->sigle }}) </option>
                        @endforeach
                    </select>
                    @error('service_demandeur')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}

                <div class="form-group col-md-6">
                    <label for="service_demandeur">Service demandeur <span class="text-danger">*</span></label>
                    <input  wire:key="service_demandeur" type="text" wire:model="service_demandeurs"  placeholder="Service demandeur" class="form-control @error('service_demandeur')
                    is-invalid
                    @enderror"disabled/>
                    @error('service_demandeur')
                        <span>{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group col-md-6">
                    <label for="chef_depart">Ordonnateur<span class="text-danger" >*</span></label>
                    <select wire:model="chef_depart" id="chef_depart" class="form-control @error('chef_depart')
                        is-invalid
                    @enderror select2" style="width: 100%;" required>
                        <option selected="selected" disabled>Saisir son nom - Email</option>
                        @foreach ($chef_departs as $user)
                            <option value="{{ $user->id }}"  @selected(old('chef_depart') == $user->id)>{{ $user->fname }} {{ $user->lname }} - {{ $user->email }}</option>
                        @endforeach
                    </select>
                    @error('chef_depart')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="controlleur">Controleur<span class="text-danger" >*</span></label>
                    <select wire:model="controlleur" id="controlleur" class="form-control @error('controlleur')
                        is-invalid
                    @enderror select2" style="width: 100%;" required>
                        <option selected="selected" disabled>Saisir son nom - Email</option>
                        @foreach ($controllers as $user)
                            <option value="{{ $user->id }}"  @selected(old('controlleur') == $user->id)>{{ $user->fname }} {{ $user->lname }} - {{ $user->email }}</option>
                        @endforeach
                    </select>
                    @error('controlleur')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6" id="num_dossier">
                    <label for="num_dossier">Numéro Dossier</label>
                    <input type="texte" class="form-control @error('num_dossier')
                    is-invalid
                    @enderror" wire:model="num_dossier" value="{{ @old('num_dossier') }}" placeholder="saisir ici!">
                    @error('num_dossier')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Contact -->
                <div class="form-group col-md-2" id="produit">
                    <label for="produit">Produit<span class="text-danger" >*</span></label>
                    <div class="col-sm-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" wire:model="produit" value="bien" checked>
                            <label class="form-check-label">Bien</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" wire:model="produit" value="service">
                            <label class="form-check-label">Service</label>
                        </div>
                    </div>
                    @error('produit')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-10" id="user_observation">
                    <label for="user_observation">Descritif</label>
                    <input type="texte" class="form-control @error('user_observation')
                    is-invalid
                    @enderror" wire:model="user_observation" value="{{ @old('user_observation') }}" placeholder="saisir ici!">
                    @error('user_observation')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- pièces jointe --}}
                {{-- <div class="form-group col-md-6">
                    <label for="filenames">Pièces jointes</label>
                    <input type="file" name="filenames[]" multiple id="filenames" class="@error('filenames.*') is-invalid @enderror form-control" style="width: 100%;">
                    @error('filenames.*')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}

            </div>

            {{-- Libéllé sur la DMD --}}
                <fieldset class="px-3 mx-2 border col-md-12" id="dynamicAddRemove">
                    <legend class="w-auto px-2 h6 text-primary text-sm-center text-md-left text-bold" style="font-size: 1.025em">Contenu de La DMD</legend>
                    <div class="row">
                        {{-- <div class="col-md-2">
                            <label for="family_article_id">Famille d'article <span class="text-danger"><sub>*</sub></span></label>
                            <select wire:model="family_article_id" name="family_article_id" id="family_article_id" class="form-control  @error('family_article_id') is-invalid @enderror" >
                                <option value="" @if (old('designation') == "") {{ 'selected' }} @endif >Choisir une famille article</option>
                                @foreach ($family_articles as $family_article)
                                    <option value="{{ $family_article->label }}" @selected(old('designation') == $family_article->label)>{{ $family_article->label }}</option>
                                @endforeach
                            </select>
                            @error('family_article_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}
                        {{-- {{ dd($articles) }} --}}

                        {{-- @if($articles->count())
                            </p> --}}
                                <div class="col-md-2">
                                    <label for="designation">Désignation <span class="text-danger"><sub>*</sub></span></label>
                                    <select wire:model="designation" name="designation" id="designation" class="form-control  @error('designation') is-invalid @enderror select2" >
                                        <option value="" @if (old('designation') == "") {{ 'selected' }} @endif >Choisir article</option>
                                        @foreach ($articles as $article)
                                            <option value="{{ $article->label }}" @selected(old('designation') == $article->label)>{{ $article->label }}</option>
                                        @endforeach
                                    </select>
                                    @error('designation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            {{-- </p>
                        @endif --}}

                        {{-- <div class="col-md-2">
                            <label for="designation">Désignation <span class="text-danger">*</span></label>
                            <input  wire:key="designation" type="text" wire:model="designation" placeholder="Désignation" class="form-control @error('designation')
                            is-invalid
                            @enderror"/>
                            @error("designation")
                                <span>{{ $message }}</span>
                            @enderror
                        </div> --}}

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
                            <label for="motif">Motif(s) <span class="text-danger">*</span></label>
                            <input  wire:key="motif" type="text" wire:model="motif" placeholder="Entrer le motif" class="form-control @error('motif')
                            is-invalid
                            @enderror"/>
                            @error("motif")
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-2">

                            <label for="beneficiaire">Bénéficiaire <span class="text-danger">*</span></label>
                            <select wire:model="beneficiaire" wire:key="beneficiaire" class="form-control @error('beneficiaire') is-invalid @enderror select2" style="width: 100%;" >
                                <option selected="selected">Choisir le bénéficiaire</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @selected(old('beneficiaire') == $user->id)>{{ $user->fname }} {{ $user->lname }} - {{ $user->email }}</option>
                                @endforeach
                            </select>
                            @error('beneficiaire')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>

                        {{-- <div class="col-md-2">
                            <label for="beneficiaire">Bénéficiaire<span class="text-danger">*</span></label>
                            <input  wire:key="beneficiaire" type="text" wire:model="beneficiaire"  placeholder="{{ auth()->user()->fname}}{{  auth()->user()->lname}}" class="form-control @error('beneficiaire')
                            is-invalid
                            @enderror"/>
                            @error('beneficiaire')
                                <span>{{ $message }}</span>
                            @enderror
                        </div> --}}

                        {{-- <div class="col-md-2">
                            <div class="form-group col-md-12">
                                <label>Bénéficiaire<span class="text-danger" >*</span></label>
                                <input class="form-control" type="text" placeholder="Entrer le nom..." wire:model.debounce.500ms="user_name" />

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
                        </div> --}}

                        <div class="col-md-2">
                            <label for="date_debut_usage">Date début usage     <span class="text-danger">*</span></label>
                            <input type="date" wire:model="date_debut_usage" wire:key="date_debut_usage" value="{{ @old('date_debut_usage') }}" placeholder="Entrer le prix unitaire" class="form-control @error('date_debut_usage')
                            is-invalid
                            @enderror" />
                            @error('date_debut_usage')
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
                                    <td style="width: 16%!important">{{ $datas['designation'] }}</td>
                                    <td style="width: 16%!important">{{ $datas['quantite'] }}</td>
                                    <td style="width: 16%!important">{{ $datas['motif'] }}</td>
                                    {{-- {{ dd($users);}} --}}
                                    {{-- <td style="width: 16%!important">{{ $datas['beneficiaire']}}</td> --}}
                                    <td style="width: 16%!important">
                                        @foreach ($users as $user )
                                            @if($user->id== $datas['beneficiaire'])
                                            {{ $user->fname }} {{ $user->lname }} - {{ $user->email }}
                                            @endif
                                        @endforeach
                                    </td>
                                    {{-- {{ dd(auth()->user()->fname); }} --}}
                                    {{-- <td style="width: 16%!important">{{ auth()->user()->fname}}{{  auth()->user()->lname}}</td> --}}
                                    <td style="width: 16%!important">{{ $datas['date_debut_usage'] }}</td>
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
                                    <th>Bénéficiaire</th>
                                    <th>Date début usage</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            @endif
                        </tfoot>
                    </table>
                </fieldset>
        </div>

        <div class="card-footer">
            {{-- <button type="submit" onclick="return confirm('Avez-vous correctement rempli les champs ? si oui cliquez sur ok')"
             id="register"
               class="btn btn-primary">
               Soumettre
            </button> --}}
            <button wire:loading wire:target="submitData" class="btn btn-primary" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Chargement ...
              </button>
            <button  wire:loading.remove type="submit" id="register" class="btn btn-primary">
                Soumettre
            </button>
        </div>
    </form>  {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
</div>
