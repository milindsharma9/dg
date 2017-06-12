@extends('admin.layouts.master')
@section('content')
<h1>{{ trans('admin/news.manage_blog') }}</h1>

<p>{!! link_to_route('admin.news.create', trans('admin/news.add_new') , null, array('class' => 'btn btn-success')) !!}</p>
<div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">{{ trans('admin/news.list') }}</div>
        </div>
        <div class="portlet-body">
            {!! Form::open(['method'=>'GET','route' => 'admin.news.index','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
            
           
          
            <div class="input-group">
        <input type="text" class="form-control" name="title" placeholder="title"> <span class="input-group-btn">
            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search">Search</span></button>
        </span>
    </div>
            {!! Form::close() !!}
            <!--table class="table table-striped table-hover table-responsive datatable  table_layout_fixed manuals_table" id="datatable-manuals" -->
                 <table class="table table-striped table-hover table-responsive   table_layout_fixed manuals_table" id="datatable-news">
                            <thead>
                                <tr>  <th>Id</th>
                                    <th>Title</th>
                                   
                                    <th>Published</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($blog as $row)
                                <tr> <td>{{ $row->id }}</td>
                                    <td>{{ $row->title }}</td>
                                    
                                    <td> @if($row->published ==1) Published @else UnPublished @endif</td>
                                    <td>
                                        {!! link_to_route('admin.news.edit', trans('admin/news.edit'), array($row->id), array('class' => 'btn btn-xs btn-info')) !!} &nbsp;
                                        {{ Html::link(url('/') . "/" . $filepath . "/" .$row->filename  , 'View Image',['target'=>'_blank' ,'class' => 'btn btn-xs btn-info'])}} &nbsp;
                                        <a href="javascript:void(0)" class='btn btn-xs btn-info' onclick="delmanual('{{ route('admin.news.destroy', $row->id) }}')">{{ trans('admin/news.delete') }}</a>
                                        
                                    </td>
                                </tr>
                                 @endforeach
                            </tbody>
            </table>
             {{ $blog->links() }}
        </div>
</div>
@endsection


@section('javascript')
<script>
   // var linktodete = '{{ url("admin/manuals/destroy") }}';
    function delmanual(id){
        //alert(id);
        if(confirm('are you sure to delete this record')){
            //location.href=linktodete + "/" + id;
            
            $.ajax({
                url: id,
                type: 'DELETE',  // user.destroy
                success: function(result) {
                    // Do something with the result
                    if(result==1){
                        alert('record deleted successfully');
                        location.href= "{{  route('admin.news.index') }}";
                        
                    } else{
                         alert('record was not  deleted');
                        location.href= "{{  route('admin.news.index') }}";
                        
                    }
                }
                });
            
            
        } else{
            
        }
    }
    $('.hidden').hide();
    /* $('#datatable-manuals').dataTable({
            retrieve: true,
            paging: false, // set paging false, not require datatable pagination in this case
            "iDisplayLength": 100,
            "aaSorting": [],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': [0]}
            ]
        }); */
  /*  $('#datatable-users').dataTable({
        retrieve: true,
        "iDisplayLength": 100,
        "aaSorting": [],
        "order": [[ 0, "desc" ]],
    });*/
</script>
@stop