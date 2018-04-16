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
        <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-success" data-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
      </td>
      <td>{{ $user->firstname }} {{ $user->lastname }}</td>
    </tr>
  @empty
    <tr>
      <td class="text-center" colspan="2">- No Record Found -</td>
    </tr>
  @endforelse
  </tbody>
</table>
{{ $users->links() }}
