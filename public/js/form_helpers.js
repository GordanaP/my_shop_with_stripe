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
