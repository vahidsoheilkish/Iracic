<!-- The Create Volume Modal -->
<div class="modal fade" id="createVolume" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title tar" id="exampleModalLabel">ثبت دوره جدید</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('conference.volume.store') }}" method="post">
                @csrf
                <input type="hidden" name="conference_id" value="{{ isset($conference->id) ? $conference->id  : '' }}"/>
                <div class="modal-body">
                    <div class="form-group tac form-inline">
                        <input type="text" name="year" id="year" class="form-control"/>
                        <label for="year" style="margin:10px;">سال انتشار</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary tar">ثبت دوره</button>
                </div>
            </form>
        </div>
    </div>
</div>