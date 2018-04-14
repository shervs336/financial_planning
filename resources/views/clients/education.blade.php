<div class="card mb-4">
  <div class="card-header">
    Educational Fund
  </div>
  <div class="card-body">
    @forelse($client->education as $education)

    @empty
      <p class="text-center">You have no education plan record yet.</p>
    @endforelse
  </div>
</div>
