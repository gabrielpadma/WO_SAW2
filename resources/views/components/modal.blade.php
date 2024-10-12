<!-- Modal -->
<div class="modal fade" id="modalTambahData" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambahData"
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
