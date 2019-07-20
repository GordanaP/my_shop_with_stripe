/**
 * Clear server side error on new input.
 *
 * @return void
 */
function clearServerSideErrorOnNewInput()
{
    $("input, textarea").on('keypress', function() {
        $(this).removeClass('is-invalid');
        $(this).siblings(".invalid-feedback").remove();
    });
}

/**
 * Show the SweetAlert2 confirmation dialog.
 *
 * @param  string deleteRecordUrl
 * @param  string afterDeleteUrl
 * @return void
 */
function swalConfirmDelete(deleteRecordUrl, afterDeleteUrl)
{
    Swal.fire({
        title: 'Are you sure you want to delete the record?',
        text: 'You will not be able to recover the record!',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        cancelButtonColor: '#718096',
        confirmButtonText: 'Delete',
        confirmButtonColor: '#e53e3e',
    }).then((result) => {
        if(result.value == true)
        {
            $.ajax({
                url: deleteRecordUrl,
                type: 'DELETE',
            })
            .done(function(response) {
                swalAlertBox(response.message)
                redirectTo(afterDeleteUrl)
            });
        }
    });
}

/**
 * Show the SweetAlert2 success dialogue box.
 *
 * @param  string message
 * @return void
 */
function swalAlertBox(message, type="success", title="Success!")
{
    Swal.fire(
        title,
        message,
        type,
    );
}

/**
 * The url to redirect to.
 *
 * @param  string redirectToUrl
 * @return void
 */
function redirectTo(redirectToUrl)
{
    window.location.reload(true);

    location.href = redirectToUrl
}