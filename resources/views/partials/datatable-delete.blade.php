<script>
    $(() => {
        $('body').on('click','a.btn-delete-datatable', function(e) {
            let that = $(e.currentTarget);
            e.preventDefault()
            Swal.fire({
                title: '{{ trans('db.confirm_delete', ['data' => $text]) }}',
                icon: 'warning',
                confirmButtonText: '{{ trans('db.confirm_text') }}',
                showCancelButton: true,
                cancelButtonText: '{{ trans('db.cancel_text') }}',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: that.attr('href'),
                        type: 'DELETE'
                    })
                    .done(() => {
                        Swal.fire({
                            title: '{{ trans('db.deleted', ['data' => $text]) }}',
                            icon: 'success'
                        }).then((nextResult) => {
                          if (nextResult.value) {
                            @if(isset($reload))
                                window.location.reload(true);
                            @else
                                $('{{ $table }}').DataTable().ajax.reload();
                            @endif
                          }                        
                        })
                    })
                    .fail(() => {
                        Swal.fire({
                            title: '{{ trans('db.failed_deleted', ['data' => $text]) }}',
                            icon: 'warning'
                        })
                    })
                }
            })
        })
    })
</script>