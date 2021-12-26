<!-- The Create Issue Modal -->
<div class="modal fade" id="createIssue" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Submit new issue</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('publication.issue.store') }}" method="post">
                <input type="hidden" id="publisher_id" name="publisher_id" value="{{ isset($publication->id) ? $publication->id : '' }}" />
                <div class="modal-body">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="volume_id" style="margin:4px 10px;">Volume</label>
                            </div>
                            <div class="col-sm-8">
                                <select class="form-control" name="volume_id" id="volume_id">
                                    @if(isset($publication->volumes))
                                        @foreach($publication->volumes as $volume)
                                            <option value="{{ $volume->id }}">year {{ $volume->year }}  </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <label for="month" style="margin:10px;">
                                    @if($publication)
                                        @switch($publication->publish_order)
                                            @case('month')
                                                Month
                                            @break

                                            @case('season')
                                                Season
                                            @break

                                            @case('half-year')
                                                Semester
                                            @break
                                        @endswitch
                                    @endif
                                </label>
                            </div>
                            <div class="col-sm-8">
                                <select id="duration" name="duration" class="form-control">
                                    @if($publication)
                                        @php($period = json_decode($period->value) )
                                        @foreach($period as $p)
                                            <option value="{{$p}}">{{$p}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label for="pages_number_from" style="margin:10px;">Page number - start</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="pages_number_from" id="pages_number_from" class="form-control"/>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-5">
                                <label for="pages_number_to" style="margin:10px;">Page number - end</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="pages_number_to" id="pages_number_to" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="special_issue">Special issue</label>
                            <input type="checkbox" name="special_issue" id="special_issue" class="checkbox" value="1" style="vertical-align:-4px; margin:0 3px;" />
                        </div>
                        <div class="form-group" id="special_issue_description" style="display:none;">
                            <label for="special_description">Special issue description</label>
                            <input type="text" id="special_description" name="special_description" class="form-control"/>
                        </div>
                        <div class="tal">
                            <button type="submit" class="btn btn-sm btn-primary">Submit issue</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>