@extends('layout')
@section('content')
<div class="content">
    <div class="row">
        @foreach ($books as $item)
            <div class="col-lg-3 col-sm-6 d-flex">
                <div class="productset flex-fill" style="box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1); border: 1px solid rgba(236, 236, 236, 0.933); border-radius: 8px">
                    <div class="productsetimg" style="height: 300px;">
                        @if ($item->cover)
                        <img src="{{ asset('images/' . $item->cover) }}" style="height: 100%; width: 100%" alt="img">                            
                        @else
                        <div class="text-center py-3">No Image</div>   
                        @endif
                    </div>
                    <div class="productsetcontent">
                        <h5>{{ $item->year }}</h5>
                        <h4>{{ $item->title }}</h4>
                    </div>
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <a href="{{ route('book.detail', ['id' => $item->id]) }}" class="btn btn-success btn-sm me-2"><i class="fas fa-info-circle"></i></a>
                        @if($item->stock > 0)
                            @if ($item->isBorrowed(Auth::id()))
                                <button type="submit" class="btn btn-secondary btn-sm me-2" disabled><i class="fas fa-book"></i> <span style="font-size: 12px">Borrow</span></button>    
                            @else
                                <!-- Borrow button for available stock -->
                                <form action="{{ route('borrow', ['book' => $item->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm me-2"><i class="fas fa-book"></i> <span style="font-size: 12px">Borrow</span></button>
                                </form>
                            @endif
                        @else
                            <!-- Button to trigger modal pop-up -->
                            <button type="button" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#alertModal">
                                <i class="fas fa-book"></i> <span style="font-size: 12px">Borrow</span>
                            </button>
                        @endif
                        @if ($item->isInCollection(Auth::id()))
                            <button class="btn btn-secondary btn-sm" disabled><i class="far fa-heart"></i> <span style="font-size: 12px">Collection</span></button>
                        @else
                            <form action="{{ route('addToCollection', ['book' => $item->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-heart"></i> <span style="font-size: 12px">Collection</span></button>
                            </form>
                        @endif
                    </div>                    
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="alertModalLabel">Alert</h5>
          <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Maaf, buku ini sudah tidak tersedia untuk dipinjam.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary d-flex align-center" style="width: 20px; height: 40px" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>    
<script>
    var myModal = new bootstrap.Modal(document.getElementById('alertModal'), {
        keyboard: false
    });
    myModal.show();
</script>

@endsection
