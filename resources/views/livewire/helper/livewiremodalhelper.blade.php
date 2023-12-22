<script>
    document.addEventListener('livewire:init', () => {
        // CLOSE MODAL
        Livewire.on('closemodal', () => {
            var modal = bootstrap.Modal.getInstance(document.getElementById('createoreditModal'))
            modal.hide();
        });
        // EDIT
        Livewire.on('editmodal', () => {
            var myModal = new bootstrap.Modal(document.getElementById('createoreditModal'))
            myModal.show();
        });
        // SHOW
        Livewire.on('showmodal', () => {
            var myModal = new bootstrap.Modal(document.getElementById('showModal'))
            myModal.show();
        });
        // CLOSE RESET
        var myModal = document.getElementById('createoreditModal')
        if (myModal) {
            myModal.addEventListener('hidden.bs.modal', () => Livewire.dispatch('formreset'))
        }
    });
</script>
