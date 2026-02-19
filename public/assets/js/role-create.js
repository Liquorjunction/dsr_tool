// Role Create Page JS

document.addEventListener('DOMContentLoaded', function() {
  const rows = document.querySelectorAll('.rc-perm-row');
  const selectAllBtn = document.getElementById('selectAll');
  const deselectAllBtn = document.getElementById('deselectAll');
  const countEl = document.getElementById('selectedCount');

  function updateRowVisual(row) {
    const checkbox = row.querySelector('input[type="checkbox"]');
    if (checkbox.checked) {
      row.classList.add('checked');
    } else {
      row.classList.remove('checked');
    }
  }

  function updateTotalCount() {
    const checked = document.querySelectorAll('.rc-perm-row input:checked').length;
    countEl.textContent = checked;
  }

  function updateGroupCount(groupName) {
    const groupRows = document.querySelectorAll('.rc-perm-row[data-group="' + groupName + '"]');
    const groupChecked = Array.from(groupRows).filter(row =>
      row.querySelector('input[type="checkbox"]').checked
    ).length;
    const groupCountEl = document.querySelector('.rc-group-count[data-group="' + groupName + '"] .group-selected');
    if (groupCountEl) {
      groupCountEl.textContent = groupChecked;
    }
  }

  rows.forEach(function(row) {
    const checkbox = row.querySelector('input[type="checkbox"]');
    const groupName = row.getAttribute('data-group');
    updateRowVisual(row);
    row.addEventListener('click', function(e) {
      if (e.target === checkbox) return;
      checkbox.checked = !checkbox.checked;
      updateRowVisual(row);
      updateTotalCount();
      updateGroupCount(groupName);
    });
    checkbox.addEventListener('change', function() {
      updateRowVisual(row);
      updateTotalCount();
      updateGroupCount(groupName);
    });
  });

  selectAllBtn.addEventListener('click', function() {
    rows.forEach(function(row) {
      const checkbox = row.querySelector('input[type="checkbox"]');
      const groupName = row.getAttribute('data-group');
      checkbox.checked = true;
      updateRowVisual(row);
      updateGroupCount(groupName);
    });
    updateTotalCount();
  });

  deselectAllBtn.addEventListener('click', function() {
    rows.forEach(function(row) {
      const checkbox = row.querySelector('input[type="checkbox"]');
      const groupName = row.getAttribute('data-group');
      checkbox.checked = false;
      updateRowVisual(row);
      updateGroupCount(groupName);
    });
    updateTotalCount();
  });

  document.querySelectorAll('.group-select-all').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.stopPropagation();
      const groupName = this.getAttribute('data-group');
      const groupRows = document.querySelectorAll('.rc-perm-row[data-group="' + groupName + '"]');
      groupRows.forEach(function(row) {
        const checkbox = row.querySelector('input[type="checkbox"]');
        checkbox.checked = true;
        updateRowVisual(row);
      });
      updateGroupCount(groupName);
      updateTotalCount();
    });
  });

  document.querySelectorAll('.group-deselect-all').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
      e.stopPropagation();
      const groupName = this.getAttribute('data-group');
      const groupRows = document.querySelectorAll('.rc-perm-row[data-group="' + groupName + '"]');
      groupRows.forEach(function(row) {
        const checkbox = row.querySelector('input[type="checkbox"]');
        checkbox.checked = false;
        updateRowVisual(row);
      });
      updateGroupCount(groupName);
      updateTotalCount();
    });
  });

  const allGroups = [...new Set(Array.from(rows).map(row => row.getAttribute('data-group')))];
  allGroups.forEach(updateGroupCount);
  updateTotalCount();
});
