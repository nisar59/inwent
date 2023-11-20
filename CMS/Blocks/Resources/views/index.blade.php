 @extends('layouts.template')
@section('content')

@section('css')

  <style>
/*  .ui-state-highlight { height: 1.5em; line-height: 1.2em; list-style: none; contain: 'Drop here'; background: red;}
*/  

.tooltip .tooltip-arrow:before {
    border-top-color: #006BA6 !important;
}

.tooltip .tooltip-inner {
    background-color: #006BA6;
    width: 350;
    max-width: 350px;
}
  </style>

@endsection

<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Blocks</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        
                        <li class="breadcrumb-item active">Blocks</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-6 col-md-6">
                <div class="card card-primary">
                    <div class="card-header bg-white p-3">
                        <h4 class="card-title">Page Sections</h4>
                    </div>
                    <div class="card-body">
                        <ol class="p-0" id="page-sections" style="height:100vh">
                            @if($page->blocks->count()>0)
                            @foreach($page->blocks as $pb)
                            @php
                            $block_name=ucfirst($pb->block_name);
                            @endphp
                            <li class="bg-primary row mb-1">
                                <h5 class="text-white col-8">{{str_replace('_', ' ',$block_name)}}</h5>
                                <span class="col-3 handle text-end settings" data-sectionid="{{$pb->id}}"><i class="fa fa-cog text-white fa-lg mt-2" aria-hidden="true"></i>
                                </span>
                                <span class="col-1 text-end"><a href="{{url('blocks/destroy/'.$pb->id)}}"><i class="fas fa-expand-arrows-alt text-danger fa-lg mt-2" aria-hidden="true"></i></a></span>
                                <input type="hidden" name="sections[]" class="section" value="{{$pb->block_name}}">
                            </li>
                            @endforeach
                            @else
                                <p id="empty-block" class="text-center">There is no block in this page, drag blocks from right container and drop here to add in this page.</p>
                            @endif
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6">
                <div class="card card-primary">
                    <div class="card-header bg-white p-3">
                        <h4 class="card-title">Sections</h4>
                        <p class="m-0">Drag the section to the left side you want to show on the page.</p>
                    </div>
                    <div class="card-body">
                        
                        <ol id="sections" >
                            @foreach(Blocks() as $key=> $block)
                            @php
                            $block_name=ucfirst($key);
                            @endphp
                            <li class="bg-primary row mb-1" data-toggle="tooltip" title='<img src="{{asset("blocks/".$block["sample"])}}" alt="Sample not found" class="w-100" />'>
                                <h5 class="text-white col-8">{{str_replace('_', ' ',$block_name)}}</h5>
                                <span class="col-4 handle text-end"><i class="fa fa-arrows-alt text-white fa-lg mt-2"></i></span>
                                <input type="hidden" name="sections[]" class="section" value="{{$key}}">
                            </li>
                            @endforeach
                        </ol>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="mdl"></div>
<!-- /Page Wrapper -->
@endsection
@section('js')

<script>

$(document).ready(function () {

$('[data-toggle="tooltip"]').tooltip({
    animated: 'fade',
    placement: 'top',
    html: true
});


$("#sections").sortable({
    group: {
        name: 'shared',
        pull: 'clone',
        put: false // To clone: set pull to 'clone'
    },
    animation: 150,
    sort: false,

});

$("#page-sections").sortable({
    group: 'shared', // To clone: set pull to 'clone'
    animation: 150,
    onAdd: function( event ) {
        $("#empty-block").remove();
        AddSectionData(event);
    }
});



function AddSectionData(event) {
            var item=event.item;  
            var inpt=$(item).find('.section'); 
            $(item).find('.handle').addClass('settings col-3');
            $(item).find('.handle').removeClass('col-4');
            $(item).find('.handle').html('<i class="fa fa-cog text-white fa-lg mt-2" aria-hidden="true"></i>');

    $.ajax({
        url:"{{url('blocks/create/'.$page->id)}}/"+inpt.val(),
        type:"POST",
        data:{_token:"{{csrf_token()}}"},
        success:function(res){
            if(res.success){
                $("#mdl").html(res.html);
                 $(item).find('.handle').attr('data-sectionid', res.data);
                 $(item).append(`<span class="col-1 text-end"><a href="{{url('blocks/destroy/')}}/`+res.data+`"><i class="fas fa-expand-arrows-alt text-danger fa-lg mt-2" aria-hidden="true"></i></a></span>`)
                $("#PageContentModal").modal('show');
            }else{

            error('Something went wrong, please refresh page and try again');
            }
        },
        error:function(res) {
            error('Something went wrong, please refresh page and try again');
        }
    })
}

function ModifySectionData(id) {
    
    $.ajax({
        url:"{{url('blocks/edit/')}}/"+id,
        type:"GET",
        data:{},
        success:function(res){
            if(res.success){
                $("#mdl").html(res.html);
                $("#PageContentModal").modal('show');
            }else{

            error('Something went wrong, please refresh page and try again');
            }
        },
        error:function(res) {
            error('Something went wrong, please refresh page and try again');
        }
    })
}


$(document).on('click','.settings',function() {
    var id=$(this).data('sectionid');

ModifySectionData(id);

});


});

</script>
@endsection