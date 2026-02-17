@php($__uid = uniqid('status-switch-'))
<input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger"
    data-url="{{ $toggle_url }}" data-id="{{ $id }}" data-variants-all-active="{{ $variants_all_active ?? 0 }}"
    data-variants-all-inactive="{{ $variants_all_inactive ?? 0 }}" @if ($status === 'active') checked @endif
    @if (!empty($is_only_active)) disabled title="At least one slider must remain active" @endif
    id="{{ $__uid }}">
<label class="pl-2 form-check-label" for="{{ $__uid }}"></label>
@if (!empty($is_only_active))
    <input type="hidden" name="__only_active_guard" value="1" />
@endif
