<!-- The Create Volume Modal -->
<div class="modal fade" id="createVolume" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content tar">
            <div class="modal-header">
                <h4 class="modal-title tar" id="exampleModalLabel">Submit new volume</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user.publication.volume.store') }}" method="post" class="rtl">
                @csrf
                <input type="hidden" name="publication_id" value="{{ isset($publication->id) ? $publication->id : '' }}"/>
                <div class="modal-body">
                    <div class="form-group tac">
                        <label for="year" style="margin:10px;">publish year</label>
                        <select name="year" id="year" class="form-control">
                            @if(isset($publication) )
                                @for($i = (int)$publication->first_publish_year; $i<=$current_year; $i++ )
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            @endif
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary tar">Submit volume</button>
                </div>
            </form>
        </div>
    </div>
</div>