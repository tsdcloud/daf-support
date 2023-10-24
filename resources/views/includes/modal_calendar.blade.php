
{{-- Modal to Add event --}}
<button type="button" id="launch_modal" class="btn btn-outline-primary block btn-lg d-none" data-toggle="modal" data-target="#iconModal">
    Launch Modal
</button>
<div wire:ignore.self class="modal fade text-left" id="iconModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel2">
                    <i class="ft-calendar"></i>
                    Ajouter un évènement
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form style="text-align: left;" wire:key="addEvent" class="event_form" method="post" action="{{ route('planning.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Titre de l'évènement <sup class="text-danger">*</sup></label>
                        <input id="title" wire:ignore.self name="title" type="text" class="form-control @error('title') is-invalid @enderror" required autofocus placeholder="Titre de l'évènement">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="responsable">Responsable de l'évènement (Facultatif)</label>
                        <input id="responsable" wire:ignore.self name="responsable" type="text" class="form-control @error('responsable') is-invalid @enderror" placeholder="Nom du responsable de l'évènement">
                        @error('responsable')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label for="start_date">Date de début <sup class="text-danger">*</sup></label>
                            <div class='input-group date' id='CalendarDateTimeStart'>
                                <input type='text' placeholder="Cliquer sur l'icône" wire:ignore.self name="start" class="form-control @error('start') is-invalid @enderror" required/>
                                <span class="input-group-addon">
                                    <span class="ft-calendar"></span>
                                </span>
                            </div>
                            @error('start')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label for="start_date">Heure de début</label>
                            <div class = 'input-group date' id='timepickerstart'>
                                <input type = 'text' placeholder="Cliquer sur l'icône" name="timestart" class="form-control @error('start') is-invalid @enderror" wire:ignore.self/>
                                <span class = "input-group-addon">
                                    <span class = "glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                            @error('start')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label for="start_date">Date de fin</label>
                            <div class='input-group date' id='CalendarDateTimeEnd'>
                                <input type='text' placeholder="Cliquer sur l'icône" name="end" class="form-control @error('end') is-invalid @enderror" wire:ignore.self/>
                                <span class="input-group-addon">
                                    <span class="ft-calendar"></span>
                                </span>
                            </div>
                            @error('end')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label for="start_date">Heure de fin</label>
                            <div class = 'input-group date' id='timepickerend'>
                                <input type = 'text' placeholder="Cliquer sur l'icône" name="timeend" class="form-control @error('timeend') is-invalid @enderror" wire:ignore.self/>
                                <span class = "input-group-addon">
                                    <span class = "glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                            @error('timeend')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="form-group d-none" style="display:none!important">
                        <input type="text" class="form-control" name="id">
                        <input type="text" class="form-control" value="{{ $niveau_id }}" name="niveau_id">
                        <input type="text" class="form-control" value="{{ $session_id }}" name="session_id">
                    </div>
                </div>

                <div class="modal-footer" style="display:block!important">
                    <div class="row w-100" style="margin-left:0px!important">
                        <div class="col-6">
                            <button type="button" class="btn grey btn-danger float-left" data-dismiss="modal" style="margin-left:-15px!important">
                                <i class="ft-x"></i>
                                Annuler
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary float-right" style="margin-right:-15px!important">
                                <i class="ft-save"></i> Enregistrer
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal to Edit event --}}
<button type="button" id="launch_modal_edit" class="btn btn-outline-primary block btn-lg d-none" data-toggle="modal" data-target="#iconModal_edit">
    Launch Modal
</button>
<div wire:ignore.self class="modal fade text-left" id="iconModal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel2">
                    <i class="ft-calendar"></i>
                    Mettre à jour un évènement
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form style="text-align: left;" wire:key="editEvent" method="post" action="{{ route('planning.update') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Titre de l'évènement <sup class="text-danger">*</sup></label>
                        <input id="title_edit" wire:ignore.self value="{{ $updateEvenement['title'] }}" name="title" type="text" class="form-control @error('updateEvenement.title') is-invalid @enderror" required autofocus placeholder="Titre de l'évènement">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="responsable_edit">Responsable de l'évènement (Facultatif)</label>
                        <input id="responsable_edit" wire:ignore.self  value="{{ $updateEvenement['responsable'] }}" name="responsable" type="text" class="form-control @error('responsable') is-invalid @enderror" placeholder="Nom du responsable de l'évènement">
                        @error('responsable')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label for="start_date">Date de début <sup class="text-danger">*</sup></label>
                            <div class='input-group date' id='CalendarDateTimeStart_edit'>
                                <input type='text' placeholder="Cliquer sur l'icône" wire:ignore.self value="{{ $updateEvenement['start'] }}" name="start" class="form-control @error('updateEvenement.start') is-invalid @enderror" required/>
                                <span class="input-group-addon">
                                    <span class="ft-calendar"></span>
                                </span>
                            </div>
                            @error('start')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label for="start_date">Heure de début</label>
                            <div class = 'input-group date' id='timepickerstart_edit'>
                                <input type = 'text' placeholder="Cliquer sur l'icône" name="timestart" value="{{ $updateEvenement['timestart'] }}" class="form-control @error('updateEvenement.timestart') is-invalid @enderror" wire:ignore.self/>
                                <span class = "input-group-addon">
                                    <span class = "glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                            @error('timestart')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label for="start_date">Date de fin</label>
                            <div class='input-group date' id='CalendarDateTimeEnd_edit'>
                                <input type='text' placeholder="Cliquer sur l'icône" name="end" value="{{ $updateEvenement['end'] }}" class="form-control @error('updateEvenement.end') is-invalid @enderror" wire:ignore.self/>
                                <span class="input-group-addon">
                                    <span class="ft-calendar"></span>
                                </span>
                            </div>
                            @error('end')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label for="start_date">Heure de fin</label>
                            <div class = 'input-group date' id='timepickerend_edit'>
                                <input type = 'text' placeholder="Cliquer sur l'icône" value="{{ $updateEvenement['timeend'] }}" name="timeend" class="form-control @error('updateEvenement.timeend') is-invalid @enderror" wire:ignore.self/>
                                <span class = "input-group-addon">
                                    <span class = "glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                            @error('timeend')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="form-group d-none" style="/*display:none*/">
                        <input type="text" class="form-control" name="id" value="{{ $updateEvenement['id'] }}">
                        <input type="text" class="form-control" value="{{ $niveau_id }}" name="niveau_id">
                        <input type="text" class="form-control" value="{{ $session_id }}" name="session_id">
                    </div>
                </div>

                <div class="modal-footer" style="display:block!important">
                    <div class="row w-100" style="margin-left:0px!important">
                        <div class="col-6">
                            <button type="button" class="btn grey btn-danger float-left" data-dismiss="modal" style="margin-left:-15px!important">
                                <i class="ft-x"></i>
                                Annuler
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary float-right" style="margin-right:-15px!important">
                                <i class="ft-save"></i> Mettre à jour
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- le modal important ici est celui du haut. Celui du bas est juste pour les soummission d'evenement dont le niveau n'est pas encore choisi--}}
<div wire:ignore.self class="modal fade text-left" id="iconModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel2">
                    <i class="ft-calendar"></i>
                    Ajouter un évènement
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form style="text-align: left;"wire:key="deleteEvent" wire:submit.prevent="submitEvent()">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Titre de l'évènement <sup class="text-danger">*</sup></label>
                        <input id="title" wire:ignore.self name="title2" type="text" class="form-control @error('evenement.title') is-invalid @enderror" required autofocus>
                        @error('evenement.title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label for="start_date">Date de début <sup class="text-danger">*</sup></label>
                            <div class='input-group date' id='CalendarDateTimeStart2'>
                                <input type='text' placeholder="Cliquer sur l'icône" wire:ignore.self name="start" class="form-control @error('evenement.start') is-invalid @enderror" required/>
                                <span class="input-group-addon">
                                    <span class="ft-calendar"></span>
                                </span>
                            </div>
                            @error('evenement.start')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label for="start_date">Heure de début</label>
                            <div class = 'input-group date' id='timepickerstart2'>
                                <input type = 'text' placeholder="Cliquer sur l'icône" name="timestart" class="form-control @error('evenement.start') is-invalid @enderror" wire:ignore.self/>
                                <span class = "input-group-addon">
                                    <span class = "glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                            @error('evenement.start')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label for="start_date">Date de fin</label>
                            <div class='input-group date' id='CalendarDateTimeEnd2'>
                                <input type='text' placeholder="Cliquer sur l'icône" wire:ignore.self name="end" class="form-control @error('evenement.start') is-invalid @enderror"/>
                                <span class="input-group-addon">
                                    <span class="ft-calendar"></span>
                                </span>
                            </div>
                            @error('evenement.start')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label for="start_date">Heure de début</label>
                            <div class = 'input-group date' id='timepickerend2'>
                                <input type = 'text' placeholder="Cliquer sur l'icône" name="timeend" class="form-control @error('evenement.start') is-invalid @enderror" wire:ignore.self/>
                                <span class = "input-group-addon">
                                    <span class = "glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                            @error('evenement.start')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="modal-footer" style="display:block!important">
                    <div class="row w-100" style="margin-left:0px!important">
                        <div class="col-6">
                            <button type="button" class="btn grey btn-danger float-left" data-dismiss="modal" style="margin-left:-15px!important">
                                <i class="ft-x"></i>
                                Annuler
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary float-right" style="margin-right:-15px!important" onclick="displayInputDate();">
                                <i class="ft-save"></i> Enregistrer
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<button type="button" id="launch_modal2" class="btn btn-outline-primary block btn-lg d-none" data-toggle="modal" data-target="#iconModal2">
    Launch Modal
</button>
<!-- Modal -->
