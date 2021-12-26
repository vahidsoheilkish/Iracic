<!-- The Create Issue Modal -->
<div class="modal fade" id="createIssue" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content tar">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ثبت شماره جدید</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin:0;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('publication.issue.store.fa') }}" method="post">
                <input type="hidden" id="publisher_id" name="publisher_id" value="{{ isset($publication->id) ? $publication->id : '' }}" />
                <div class="modal-body">
                    @csrf
                    <div class="modal-body rtl">
                        <div class="form-group row tar">
                            <div class="col-sm-4">
                                <label for="volume_id" style="margin:4px 10px;">دوره</label>
                            </div>
                            <div class="col-sm-8">
                                <select class="form-control" name="volume_id" id="volume_id">
                                    @if(isset($publication->volumes))
                                        @foreach($publication->volumes as $volume)
                                            <option value="{{ $volume->id }}">سال {{ $volume->year }}  </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row tar">
                            <div class="col-sm-4">
                                <label for="month" style="margin:10px;">
                                    @if($publication)
                                        @switch($publication->publish_order)
                                            @case('month')
                                                ماه انتشار
                                            @break

                                            @case('season')
                                                فصل انتشار
                                            @break

                                            @case('half-year')
                                                نیمسال انتشار
                                            @break
                                        @endswitch
                                    @endif
                                </label>
                            </div>
                            <div class="col-sm-8">
                                <select id="duration" name="duration" class="form-control">
                                    @if($publication)
                                        @php($period = json_decode($period->value) )
                                        @foreach($period as $index=>$value)
                                            <option value="{{$value}}">{{$value}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row form-group tar">
                            <div class="col-sm-5">
                                <label for="pages_number_from" style="margin:10px;">شماره صفحه - شروع</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="pages_number_from" id="pages_number_from" class="form-control"/>
                            </div>
                        </div>
                        <div class="row form-group tar">
                            <div class="col-sm-5">
                                <label for="pages_number_to" style="margin:10px;">شماره صفحه - پایان</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="pages_number_to" id="pages_number_to" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="special_issue">شماره ویژه</label>
                            <input type="checkbox" name="special_issue" id="special_issue" class="checkbox" value="1" style="vertical-align:-4px; margin:0 3px;" />
                        </div>
                        <div class="form-group" id="special_issue_description">
                            <label for="special_description">توضیحات شماره ویژه</label>
                            <input type="text" id="special_description" name="special_description" class="form-control"/>
                        </div>
                        <div class="tal">
                            <button type="submit" class="btn btn-sm btn-primary">ثبت شماره</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>