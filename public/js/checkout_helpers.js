/**
 * Get the checkout addresses.
 *
 * @param  string addressType
 * @param  array adressFields
 * @return array
 */
function getAddress(addressType, addressFields)
{
    var address = { };

    $.each(addressFields, function(index, fieldName) {

        var fieldId = addressType+'_'+fieldName;

        if(getById(fieldId))
        {
            address[fieldName] = getById(fieldId).value;
        }
    });

    return address;
}

/**
 * Get the address field.
 *
 * @param  string fieldId
 * @return JS Elements Object
 */
function getById(fieldId)
{
    return document.getElementById(fieldId);
}
