<style>
.tox-tinymce-aux {
    z-index: 999999!important;
}
.tox .tox-menu{
    background-color: white !important;
}
</style>
<!-- sample modal content -->
<div id="PageContentModal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                    @php
                    $block_name=ucfirst($data->block_name);
                    @endphp
                <h5 class="modal-title" id="myModalLabel1">{{str_replace('_', ' ',$block_name)}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('/blocks/update/'.$data->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        @php
                            $block_data=json_decode($data->data);
                        @endphp
                        @if(count($block['data'])>0)
                        @foreach($block['data'] as $key=> $content)
                        @php
                            $label=str_replace('_',' ',$key);
                            $blck_name=$content['name'];
                        @endphp
                        <div class="col-md-12">

                            @if($content['type']=='table')

                                    @php

                                    $tble_data=\DB::table($blck_name)->where('status',1)->get();

                                    @endphp

                                    <select name="{{$blck_name}}" class="form-control" id="">
                                        <option value="">Select</option>
                                        @foreach($tble_data as $tbl)
                                            <option value="{{$tbl->id}}" @if($block_data->$blck_name==$tbl->id) selected @endif>{{$tbl->name}}</option>
                                        @endforeach

                                    </select>













                            @elseif($content['type']=='button')
                            <hr>
                            <h5 class="fw-bold">Action</h5>

                                    <select name="{{$blck_name}}" class="form-control">
                                        <option value="">Select</option>
                                        @foreach(ButtonTypes() as $bt=>$btname)
                                            <option value="{{$bt}}" @if($block_data->$blck_name==$bt) selected @endif>{{$btname}}</option>
                                        @endforeach

                                    </select>













                            @elseif($content['type']=='listing')
                            <hr>
                            <div id="listing">
                                <div class="d-flex justify-content-between mb-2">
                                    <h5 class="fw-bold text-capitalize">{{ucfirst($label)}}</h5>
                                    <button type="button" data-count="0" data-name="{{$blck_name}}" class="btn btn-success add-list">+</button>
                                </div>
                                @if($block_data->$blck_name!=null && is_array($block_data->$blck_name))
                                @foreach($block_data->$blck_name as $likey=>$lidata)
                                <div class="row listing-row" >
                                    <div class="col-5 form-group">
                                        <label for="">List Heading</label>
                                        <input type="text" value="{{$lidata->heading}}" name="{{$blck_name}}[{{$likey}}][heading]" class="form-control" placeholder="List Heading">
                                    </div>
                                    <div class="col-6 form-group">
                                        <label for="">List Description</label>
                                        <input type="text" value="{{$lidata->description}}" name="{{$blck_name}}[{{$likey}}][description]" class="form-control" placeholder="List Description">
                                    </div>
                                    <div class="col-1 text-center">
                                        <label for="">Action</label>

                                        <button type="button" class="btn btn-danger remove-list">x</button>
                                    </div>
                                </div>
                                @endforeach

                                @endif
                            </div>











                            
                            @elseif($content['type']=='sub_sections')
                            <hr>
                            <div id="sub-sections">
                                <h5 class="fw-bold text-capitalize">{{ucfirst($label)}}</h5>
                                @for($t=0; $t<$content['total_sections']; $t++)
                                @foreach($content['sub_sections'] as $seckey => $sec)
                                 <div class="row">
                                    @php
                                      $seclbl=str_replace('_',' ',$seckey);
                                      $sec_name=$sec['name'];
                                      $sec_data=isset($block_data->$blck_name) ? $block_data->$blck_name : null;

                                      $indexed_value=isset($sec_data[$t]) ? $sec_data[$t] : null;

                                      $final_value=isset($indexed_value->$sec_name) ? $indexed_value->$sec_name : null;

                                    @endphp

                                    @if($sec['type']=='listing')
                                    <div class="col-12 form-group">
                                        <label for="" class="text-capitalize">{{$seclbl}}</label>
                                        <input type="text" class="form-control" placeholder="Enter multiple values seprated by comma (first,second,third,fourth)" name="{{$blck_name}}[{{$t}}][{{$sec_name}}]" @if($final_value!=null && is_array($final_value)) value="{{implode(',', $final_value)}}" @endif>
                                    </div>
                                    @elseif($sec['type']=='file')
                                    <div class="col-12 form-group">
                                        <label for="" class="text-capitalize">{{$seclbl}}</label>
                                        <input type="file" class="form-control" placeholder="{{$seclbl}}" name="{{$blck_name}}[{{$t}}][{{$sec_name}}]">
                                        @if($final_value!=null)
                                        <a target="_blank" href="{{StorageFile($final_value)}}">{{$final_value}}</a>
                                        @endif
                                    </div>
                                    @else
                                        
                                    <div class="col-12 form-group">
                                        <label for="" class="text-capitalize">{{$seclbl}}</label>
                                        <input type="text" class="form-control" placeholder="{{$seclbl}}" name="{{$blck_name}}[{{$t}}][{{$sec_name}}]"  @if($final_value!=null) value="{{$final_value}}" @endif>
                                    </div>
                                        
                                    @endif
                                 </div>
                                @endforeach
                                @endfor

                            </div>

                            @elseif($content['type']=='records')
                            <div class="col-12 form-group">
                            <label class="text-capitalize">Enter no of record to show from ( {{ucfirst($label)}}) table</label>

                            <input type="text" class="form-control @if(isset($content['class'])) {{$content['class']}} @endif" name="{{$blck_name}}" placeholder="Enter no of record to show from ( {{ucfirst($label)}}) table"
                            @if(isset($block_data->$blck_name)) value="{{$block_data->$blck_name}}" @endif
                            >

                            </div>










                            @else
                            <label for="" class="text-capitalize" >{{ucfirst($label)}}</label>

                            <input type="{{$content['type']}}" class="form-control @if(isset($content['class'])) {{$content['class']}} @endif" name="{{$blck_name}}" placeholder="{{ucfirst($label)}}"
                            @if($content['type']!="file" && isset($block_data->$blck_name)) value="{{$block_data->$blck_name}}" @endif
                            >
                            @if($content['type']=="file" && isset($block_data->$blck_name))
                            <a target="_blank" href="{{StorageFile($block_data->$blck_name)}}">{{$block_data->$blck_name}}</a>
                            @endif

                            @endif

                        </div>
                        @endforeach

                        @else
                        <p class="text-center">Customization is not required</p>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit"
                    class="btn btn-primary waves-effect waves-light">Save
                    changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">



  $(document).on('click', '.add-list', function() {
     var count=$(this).data('count');
     var name=$(this).data('name');
     var hdng=name+"["+count+"][heading]";
     var desc=name+"["+count+"][description]";
     var new_count=parseInt(count)+1;

     var html_list=`<div class="row listing-row">
                                <div class="col-5 form-group">
                                    <label for="">List Heading</label>
                                    <input type="text" name="`+hdng+`" class="form-control" placeholder="List Heading">
                                </div>
                                <div class="col-6 form-group">
                                    <label for="">List Description</label>
                                    <input type="text" name="`+desc+`" class="form-control" placeholder="List Description">
                                </div>
                                <div class="col-1 text-center">
                                    <label for="">Action</label>
                                    <button type="button" class="btn btn-danger remove-list">x</button>
                                </div>
                            </div>`;

    $("#listing").append(html_list);
    $(this).data('count', new_count);
  });

$(document).on('click', '.remove-list', function() {

   $(this).closest('.row .listing-row').remove();
});
</script>