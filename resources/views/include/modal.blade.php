<div class="modal" tabindex="-1" role="dialog" aria-hidden="true" id="delete-modal-{{ $id }}">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Delete confirmation</h4>
            </div>
            <div class="modal-body">
                <h4>{{ $deleteTitle }}</h4>
                <p>{{ $deleteMessage }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <form action="{{ url($url) }}" method="POST" class="delete-form">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>

        </div>
    </div>
</div>