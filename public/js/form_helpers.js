/**
 * Display server side errors.
 *
 * @param  array errors
 * @return none
 */
function displayServerSideErrors(errors)
{
    for (error in errors)
    {
        var formattedError = error.replace(/\./g , "_");

        var invalidField = $("."+formattedError).addClass('is-invalid');
        var invalidFeedback = '<span class="invalid-feedback">'+errors[error][0]+'</span>';

        invalidField.after(invalidFeedback)
    }
}

/**
 * Remove a server side error on new input.
 *
 * @return void
 */
function clearServerSideErrorOnNewInput()
{
    $("input, textarea").on('keypress', function() {
        clearServerSideError($(this))
    });

    $("select").on('change', function () {
        clearServerSideError($(this))
    });
}

/**
 * Clear server side errors.
 *
 * @return void
 */
function clearServerSideErrors()
{
    $(".is-invalid").removeClass('is-invalid');
    $(".invalid-feedback").remove();
}

/**
 * Clear the form fields.
 *
 * @return void
 */
function clearFormFields()
{
    $('form').trigger('reset');
}


/**
 * Show the SweetAlert2 confirmation dialogue.
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

/**
 * Remove a server side error.
 *
 * @param  JQ object field
 * @return void
 */
function clearServerSideError(field)
{
    field.removeClass('is-invalid');
    field.siblings(".invalid-feedback").remove();
}