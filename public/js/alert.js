function showAlert(titleText, contentText, after = {}) {
    $('.alert').append(`
    <!-- Modal -->
    <div class="modal fade show" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title title-alert" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span  pan aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body content-alert">
                ...
                </div>
                <div class="modal-footer footer-alert">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    `);
    const element = $('#staticBackdrop');
    element.modal('show');

    title = element.find('.title-alert');
    content = element.find('.content-alert');

    title.html(titleText);
    content.html(contentText);

    $('#staticBackdrop').on('hidden.bs.modal', after);
}