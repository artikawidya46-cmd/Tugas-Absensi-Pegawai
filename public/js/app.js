document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('[data-table-search]').forEach(input => {
    const table = document.getElementById(input.dataset.tableSearch);
    if (!table) return;
    input.addEventListener('input', () => {
      const query = input.value.toLocaleLowerCase('id');
      table.querySelectorAll('tbody tr').forEach(row => {
        row.hidden = !row.textContent.toLocaleLowerCase('id').includes(query);
      });
    });
  });
});
