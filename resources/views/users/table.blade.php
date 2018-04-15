<table class="table table-bordered mb-4">
  <thead>
    <tr>
      <th>Actions</th>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
  @forelse($users as $user)
    <tr>
      <td>
        {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
          <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-success" data-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
          {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => 'return confirm("Are you sure you want to delete this user")']) !!}
        {!! Form::close() !!}
      </td>
      <td>{{ $user->name }}</td>
    </tr>
  @empty
    <tr>
      <td class="text-center" colspan="2">- No Record Found -</td>
    </tr>
  @endforelse
  </tbody>
</table>
{{ $users->links() }}
