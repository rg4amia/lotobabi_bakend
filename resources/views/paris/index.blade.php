@extends('layouts.master')

@section('title') Etablissement @endsection

@section('subTitle') Tous @endsection


@section('content')

    <section class="card">
        <div class="card-header">
            <h4 class="card-title"></h4>
        </div>
        <div class="card-content">

            <div class="card-body">

                <div class="mb-3">
                    <a class="btn btn-primary" href="{{ route('ecole.create') }}">
                        <span><i class="feather icon-plus"></i>Enregistrer une ecole</span>
                    </a>
                </div>

                <div class="table-responsive-sm">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                          {{--  @if(auth()->user()->hasRole('Admin'))
                                <th>Etablissement</th>
                            @endif--}}
                            <th>Nom etablissement</th>
                            <th>Code</th>
                            <th>Dren</th>
                            <th>Commune</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ecoles as $item)
                            <tr>
                               {{-- @if(auth()->user()->hasRole('Admin'))
                                    <td> <strong>{{ $item->ecole->nometab }}</strong></td>
                                @endif--}}
                                <td> {{ $item->nometab }}</td>
                                <td> {{ $item->code }}</td>
                                <td> {{ $item->dren }}</td>
                                <td> {{ $item->commune }}</td>

                                <td class="float-right">
                                    {{--{{route('imprime.fiche',$item->id)}}--}}
                                   {{-- <a href="#"
                                       class="btn btn-icon btn-icon rounded-circle btn-flat-primary mr-0 waves-effect waves-light">
                                        <i class="feather icon-printer"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-icon btn-icon rounded-circle btn-success mr-0 waves-effect waves-light">
                                        <i class="feather icon-target"></i>
                                    </button>--}}
                                    <a href="{{ route('ecole.edit',$item->id) }}"
                                       class="btn btn-icon btn-icon rounded-circle btn-primary mr-0 waves-effect waves-light">
                                        <i class="feather icon-edit"></i>
                                    </a>
                                    <button type="button"
                                            data-id="{{$item->id}}"
                                            data-toggle="modal"
                                            data-target="#deletedEcole"
                                            class="btn btn-icon btn-icon rounded-circle btn-danger mr-0 waves-effect waves-light">
                                        <i class="feather icon-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        @if(count($ecoles) < 1)
                            <tr>
                                <td colspan="10" class="text-center">Pas d'eleve trouvé !</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center mt-2">
                        {{ $ecoles->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </section>
    <div class="modal modal-danger fade" id="deletedEcole" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger white">
                    <h4 class="modal-title" id="myModalLabel16">Confirmation la supprimer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open(['route'=>'ecole.delete', 'files'=>true , 'methode' => 'POST']) }}

                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <p class="text-center">
                            Êtes-vous sûr de vouloir le supprimer ?
                        </p>
                        <input type="hidden" name="id" id="eleve_id" value="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Non, Annuler</button>
                        <button type="submit" class="btn btn-warning">Oui, Supprimer</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $('#deletedEcole').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);
            modal.find('.modal-body #eleve_id').val(id);
        });
    </script>
@endsection
