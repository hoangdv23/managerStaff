<script type="text/javascript">
    function showAlertToast(content, type) {
        NioApp.Toast('<p> ' + content + ' </p>', type, {
            position: 'top-right',
            progressBar: true,
            showDuration: 200,
            hideDuration: 1000,
            timeOut: 5000,
            extendedTimeOut: 1000

        });
    }


    @if(session()->has('success'))
    showAlertToast('{{ session('success') }}', 'success');
    @elseif(session()->has('error'))
    showAlertToast('{{ session('error') }}', 'error');
    @endif


    document.addEventListener('livewire:init', () => {

        function showTrigerDelete(triggerDelete, deleteEmit, title = '{{ __("Are You Sure?") }}', text = '{{ __("Record will be deleted!") }}') {
            Livewire.on(triggerDelete, ({idDelete}) => {
                Swal.fire({
                    title: title,
                    text: text,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: '{{ __("Confirm") }}',
                    cancelButtonText: '{{ __("Cancel") }}'
                }).then((result) => {
                    //if user clicks on delete
                    if (result.value) {
                        // calling destroy method to delete. id like $id in component.
                        Livewire.dispatch(deleteEmit, {id: idDelete})
                        // Listen event msgSuccess on Component. And show message
                        Livewire.on('msgSuccess', msgDel => {
                            showAlertToast(msgDel, 'success');
                        })
                    } else {
                        //Nothing
                    }
                });
            });
        }

        showTrigerDelete('triggerDelete', 'deleteItem');

//Close Modal
        Livewire.on('actionModalDispatch', (event) => {
            let modalId = event[0].modalId;
            let actionModal = event[0].actionModal;
            let flashMessage = event[0].flashMessage;
            let flashType = event[0].flashType;

            console.log(modalId, actionModal, flashMessage, flashType);

            if (actionModal == 'hide') {
                $(modalId).modal('hide');
            } else if (actionModal == 'show') {
                $(modalId).modal('show');
            }

            if (flashMessage !== null && flashType !== null) {
                showAlertToast(flashMessage, flashType);
            }
        });

    });
</script>

