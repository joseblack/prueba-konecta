$(document).ready(function () {
    $('#loader').removeClass('d-none');
    $('#loader').hide();
    
    $(document).on('click', '#btn-trash', function (event) {
        event.preventDefault();
        let href = $(this).attr('data-attr');
        console.log("ruta: " + href);
        $.ajax({
            url: href,
            beforeSend: function () {
                $('#loader').show();
            },
            
            // return the result
            success: function (result) {
                console.log("eeee" + result);
                $('#exampleModal').modal("show");
                $('#bodyres').html(result).show();
            },

            complete: function () {
                $('#loader').hide();
            },

            error: function (jqXHR, testStatus, error) {
                console.log("xxx " + error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').hide();
            },
            timeout: 8000
        })
    });


});

