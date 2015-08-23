@if(count($getTenant) > 1)
<div class="form-group">
 <form id="changetenantForm" method="POST" action="{{URL::route('home.changeTenant')}}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
     Welcome to 
     <select class="form-control" name="select_tenant">
         @foreach($getTenant as $tenant)
         <option value="{{$tenant->tenant_id}}" <?php if($tenant->tenant_id== \Session::get('tenant_id')) echo 'selected';  ?>>{{$tenant->tenant_name}}</option>
         @endforeach
     </select>

       </form>
 </div>



 @else 
    Welcome to       <b>{{ $getTenant[0]->tenant_name }}</b>
 @endif

 @section('body.script')
    <script type="text/javascript">
	    $("select[name='select_tenant']").change(function(){
	        $("#changetenantForm").submit();
	    });
	</script>
 @stop