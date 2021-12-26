<!-- The Create Volume Modal -->
<div class="modal fade" id="createVolume" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">ثبت دوره جدید</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin:0;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user.publication.volume.store.fa') }}" method="post" class="">
                @csrf
                <input type="hidden" name="publication_id" value="{{ isset($publication->id) ? $publication->id : '' }}"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="year" style="margin:10px;">سال انتشار</label>
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
                    <button type="submit" class="btn btn-sm btn-primary tar">ثبت دوره</button>
                </div>
            </form>
        </div>
    </div>
</div>