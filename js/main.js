$(document).ready(function () {
    delete_tretman();

});

$('#formaDodajTretman').submit(function () {
    event.preventDefault();
    const $form = $(this);
    const $inputs = $form.find('input, select, button, textarea');
    const serijalizacija = $form.serialize();
    console.log(serijalizacija);

    request = $.ajax({
        url: 'handler/add.php',
        type: 'post',
        data: serijalizacija
    });

    request.done(function (response, textStatus, jqXHR) {
        if (response.trim() == "uspesno") {
            alert("Nov tretman je uspesno dodat");
            console.log("Uspesno dodat novi tretman u ponudi!");
            location.reload(true);
        } else console.log("Nije dodat nov tretman ");
        console.log(response);
    });

    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Sledeca greska se desila: ' + textStatus, errorThrown);

    });

});

//Delete funkcija
function delete_tretman() {
    $(document).on('click', '#btnDelete', function () {

        var delete_id = $(this).attr('data-id');
        $('#obrisiTretman').modal('show');

        $(document).on('click', '#btnObrisi', function () {
            $.ajax({
                url: 'handler/delete.php',
                method: 'post',
                data: { del_id: delete_id }, //promenljiva koju saljemo u delete.php(nazvali smo je del_id)
                success: function (data) {
                    $('#delete-message').html(data); //id modala za brisanje iz home-a

                }
            });
            location.reload(true);
        });

    });

}


$(".edit_tretman").on("click", function () {
    $("#izmeni-tretman-modal").modal("show");
    var edit_id_p = $(this).attr("data-id1");

    $tr = $(this).closest("tr");

    var data = $tr
        .children("td")
        .map(function () {
            return $(this).text();
        })
        .get();

    console.log(data);

    $("#edit_id_p").val(edit_id_p);
    $("#up_naziv_tretmana").val(data[0].trim());
    $("#up_trajanje").val(data[1].trim());
    $("#up_cena").val(data[2].trim());


});



$(document).ready(function () {
    $("#search_text").keyup(function () {
        var txt = $(this).val();
        
       
            $.ajax({
                url: 'handler/search.php',
                method: 'post',
                data: { search: txt },
                success: function (data) {
                    $("#table_id").html(data);
                }
            });
            if (txt == "") {
                location.reload(true);
           }
        });
    
});