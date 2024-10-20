<!-- Modal -->
@props(['title', 'idModal' => 'modalTambahData'])
<div class="modal fade" id="{{ $idModal }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="Modal Data"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! $slot !!}
            </div>

        </div>
    </div>
</div>
