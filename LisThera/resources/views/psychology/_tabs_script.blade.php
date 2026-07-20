<style>
/* ===== TABS ===== */
.tabs-header {
    display: flex;
    flex-wrap: wrap;
    gap: var(--space-1);
    border-bottom: 2px solid var(--color-divider);
    margin-bottom: 0;
    padding: var(--space-4) var(--space-4) 0;
    background: var(--color-surface-offset);
    border-radius: var(--radius-lg) var(--radius-lg) 0 0;
}
.tab-btn {
    padding: var(--space-2) var(--space-4);
    border-radius: var(--radius-md) var(--radius-md) 0 0;
    font-size: var(--text-sm);
    font-weight: 500;
    color: var(--color-text-muted);
    background: transparent;
    border: none;
    border-bottom: 2px solid transparent;
    margin-bottom: -2px;
    cursor: pointer;
    transition: color var(--transition-interactive), border-color var(--transition-interactive);
}
.tab-btn:hover { color: var(--color-text); }
.tab-btn.active {
    color: var(--color-primary);
    border-bottom: 2px solid var(--color-primary);
    background: var(--color-surface);
}
.tab-pane { display: none; }
.tab-pane.active { display: block; }

/* ===== FORM COMPONENTS ===== */
.form-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--space-4);
}
.form-group { display: flex; flex-direction: column; gap: var(--space-1); }
.form-group label { font-size: var(--text-sm); font-weight: 500; color: var(--color-text); }
.form-group input,
.form-group select,
.form-group textarea {
    padding: var(--space-2) var(--space-3);
    border: 1px solid var(--color-border);
    border-radius: var(--radius-md);
    background: var(--color-surface);
    color: var(--color-text);
    font-size: var(--text-sm);
    width: 100%;
    transition: border-color var(--transition-interactive), box-shadow var(--transition-interactive);
}
.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px var(--color-primary-highlight);
}
.form-group textarea { resize: vertical; }
.col-span-2 { grid-column: span 2; }
.required { color: var(--color-error); }
.radio-group { display: flex; gap: var(--space-4); align-items: center; padding: var(--space-2) 0; }
.radio-group label { font-weight: 400; display: flex; gap: var(--space-2); cursor: pointer; }

/* ===== DOMAINS ===== */
.domains-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: var(--space-6); margin-bottom: var(--space-4); }
.domain-item { display: flex; flex-direction: column; gap: var(--space-1); }
.domain-header { display: flex; justify-content: space-between; align-items: center; }
.domain-header label { font-weight: 600; font-size: var(--text-sm); }
.domain-value { font-size: var(--text-lg); font-weight: 700; color: var(--color-primary); min-width: 24px; text-align: right; }
.range-labels { display: flex; justify-content: space-between; font-size: var(--text-xs); color: var(--color-text-muted); }
.domain-hint { font-size: var(--text-xs); color: var(--color-text-muted); margin: 0; }
input[type=range] { width: 100%; accent-color: var(--color-primary); }
.tab-hint { font-size: var(--text-sm); color: var(--color-text-muted); margin-bottom: var(--space-4); }

/* ===== NAVIGATION FOOTER ===== */
.tab-nav-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: var(--space-6);
    padding-top: var(--space-4);
    border-top: 1px solid var(--color-divider);
}
.section-title {
    font-size: var(--text-base);
    font-weight: 600;
    color: var(--color-primary);
    margin-bottom: var(--space-3);
    padding-bottom: var(--space-2);
    border-bottom: 1px solid var(--color-divider);
}
.mt-4 { margin-top: var(--space-6); }

/* ===== SEARCH ===== */
.search-form .search-fields {
    display: flex;
    gap: var(--space-4);
    align-items: flex-end;
    flex-wrap: wrap;
}
.search-form .form-group { flex: 1; min-width: 160px; }
.search-actions { display: flex; gap: var(--space-2); align-items: flex-end; padding-bottom: 1px; }

/* ===== TABLE ===== */
.action-btns { display: flex; gap: var(--space-2); align-items: center; flex-wrap: wrap; }
.practitioner-name { font-weight: 500; }
.empty-row { text-align: center; color: var(--color-text-muted); padding: var(--space-8) !important; }
.pagination-wrap { padding: var(--space-4); border-top: 1px solid var(--color-divider); }
.p-0 { padding: 0 !important; }
.mb-4 { margin-bottom: var(--space-4); }

/* ===== ALERT ===== */
.alert { padding: var(--space-3) var(--space-4); border-radius: var(--radius-md); margin-bottom: var(--space-4); }
.alert-success { background: var(--color-success-highlight); color: var(--color-success); border: 1px solid var(--color-success); }
.alert-danger  { background: var(--color-error-highlight);   color: var(--color-error);   border: 1px solid var(--color-error); }
.alert ul { margin: 0; padding-left: var(--space-4); }

@media (max-width: 768px) {
    .form-grid-2 { grid-template-columns: 1fr; }
    .col-span-2  { grid-column: span 1; }
    .tabs-header { gap: 2px; }
    .tab-btn { font-size: var(--text-xs); padding: var(--space-2) var(--space-3); }
    .domains-grid { grid-template-columns: 1fr; }
    .search-form .search-fields { flex-direction: column; }
}
</style>

<script>
(function () {
    const btns  = document.querySelectorAll('.tab-btn');
    const panes = document.querySelectorAll('.tab-pane');

    function showTab(id) {
        panes.forEach(p => p.classList.toggle('active', p.id === id));
        btns.forEach(b  => b.classList.toggle('active', b.dataset.tab === id));
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    btns.forEach(btn => btn.addEventListener('click', () => showTab(btn.dataset.tab)));

    document.querySelectorAll('.tab-next').forEach(btn =>
        btn.addEventListener('click', () => showTab(btn.dataset.next))
    );
    document.querySelectorAll('.tab-prev').forEach(btn =>
        btn.addEventListener('click', () => showTab(btn.dataset.prev))
    );

    // Destaca aba com erro de validação
    const errorFields = document.querySelectorAll('.is-invalid, [aria-invalid]');
    if (errorFields.length) {
        const pane = errorFields[0].closest('.tab-pane');
        if (pane) showTab(pane.id);
    }
})();
</script>
