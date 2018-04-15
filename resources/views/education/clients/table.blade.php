<table class="table table-bordered mb-4">
  <thead>
    <tr>
      <th>Actions</th>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
  @forelse($clients as $client)
    <tr>
      <td>
        {!! Form::open(['route' => ['clients.destroy', $client->id], 'method' => 'delete']) !!}
          <a href="{{ route('clients.dashboard', ['id' => $client->id]) }}" class="btn btn-primary" data-toggle="tooltip" title="Manage Client"><i class="fa fa-fw fa-dashboard"></i></a>
          <a href="{{ route('clients.edit', ['id' => $client->id]) }}" class="btn btn-success" data-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
          {!! Form::button('<i class="fa fa-fw fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => 'return confirm("Are you sure you want to delete this client")']) !!}
        {!! Form::close() !!}
      </td>
      <td>{{ $client->name }}</td>
    </tr>
  @empty
    <tr>
      <td class="text-center" colspan="2">- No Record Found -</td>
    </tr>
  @endforelse
  </tbody>
</table>
{{ $clients->links() }}
