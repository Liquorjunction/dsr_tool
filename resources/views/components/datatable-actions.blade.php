<div class="d-flex gap-1">
    @if (!empty($edit_url))
        <a class="btn btn-outline-primary btn-sm rounded-pill shadow-sm px-2 py-1 action-btn" href="{{ $edit_url }}" data-bs-toggle="tooltip" title="Edit" aria-label="Edit">
            <i class="mdi mdi-pencil fs-5"></i>
        </a>
    @endif
    @if (!empty($delete_url))
        <button type="button" class="btn btn-outline-danger btn-sm rounded-pill shadow-sm px-2 py-1 action-btn delete-action"
            data-delete-url="{{ $delete_url }}"
            data-delete-id="{{ $product_id ?? $id ?? $model_id ?? '' }}"
            data-bs-toggle="tooltip" title="Delete" aria-label="Delete">
            <i class="mdi mdi-delete fs-5"></i>
        </button>
    @endif
    @if (isset($view_url))
        <a class="btn btn-outline-info btn-sm rounded-pill shadow-sm px-2 py-1 action-btn" href="{{ $view_url }}" data-bs-toggle="tooltip" title="View" aria-label="View">
            <i class="mdi mdi-eye fs-5"></i>
        </a>
    @endif
    @if (isset($cancel_url))
        <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill shadow-sm px-2 py-1 action-btn cancel-action"
            data-cancel-url="{{ $cancel_url }}"
            data-cancel-id="{{ $product_id ?? $id ?? $model_id ?? '' }}"
            data-bs-toggle="tooltip" title="Cancel" aria-label="Cancel">
            <i class="mdi mdi-close fs-5"></i>
        </button>
    @endif
</div>
<style>
    .action-btn {
        transition: box-shadow 0.2s, background 0.2s, color 0.2s;
    }
    .action-btn:hover, .action-btn:focus {
        box-shadow: 0 0 0 0.15rem rgba(0,0,0,0.08);
        background: var(--bs-light);
        color: var(--bs-primary) !important;
        text-decoration: none;
    }
    .action-btn.btn-outline-danger:hover, .action-btn.btn-outline-danger:focus {
        color: var(--bs-danger) !important;
    }
    .action-btn.btn-outline-info:hover, .action-btn.btn-outline-info:focus {
        color: var(--bs-info) !important;
    }
    .action-btn.btn-outline-secondary:hover, .action-btn.btn-outline-secondary:focus {
        color: var(--bs-secondary) !important;
    }
    .action-btn i {
        vertical-align: middle;
    }
</style>
