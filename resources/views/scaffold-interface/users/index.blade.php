@extends('scaffold-interface.layouts.app')
@section('content')
<section class="content">
<div class="box box-primary">
<div class="box-header">
	<h3>All Users</h3>
</div>
	<div class="box-body">
		<a href="{{url('/users/create')}}" class = "btn btn-success"><i class="fa fa-plus fa-md" aria-hidden="true"></i> New</a>
		<table class = "table table-hover">
		<thead>
			<th>Name</th>
			<th>Email/ Gravatar</th>
			<th>Roles</th>
			<th>Permissions</th>
			<th>Actions</th>
		</thead>
		<tbody>
			@foreach($users as $user)
			<tr>
				<td><img src="{{$user->gravatarnew}}" class="gravatar"> {{$user->name}}</td>
				<td> {{$user->email}}

				| Joined {{ $date = Jenssegers\Date\Date::parse($user->created_at)->diffForHumans()}}
				| Login count: <span class="label bg-green">-</span>. Last login: <span class="label bg-yellow"> - (-)</span>.
				| settings: {{ @$user->usersettings->count() }} out of {{ App\Models\Setting::count()}}

				    <a href="{{ URL::to('user/sync_available_settings/'.$user->id) }}" class="ui labeled icon button" target="_blank" title="Syncing all usersettings">
				      <i class="cogs icon"></i>
				       Sync-up settings
				    </a>

				</td>
				<td>
				@foreach($user->roles as $role)
				<small class = 'label bg-blue'>{{$role->name}}</small>
				@endforeach
				</td>
				<td>
				@foreach($user->permissions as $permission)
				<small class = 'label bg-orange'>{{$permission->name}}</small>
				@endforeach
				</td>
				<td>
					<a href="{{url('/users/edit')}}/{{$user->id}}" class = 'btn btn-primary btn-sm'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
					<a href="{{url('users/delete')}}/{{$user->id}}" class = "btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
</div>
</section>
@endsection
