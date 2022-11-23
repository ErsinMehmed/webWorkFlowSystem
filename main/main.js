$(document).on('submit', '#userRegisterForm', function(e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("save_site_user", true);

    $.ajax({
        type: "POST",
        url: "main/action.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {

            var res = jQuery.parseJSON(response);
            console.log(res);
            if (res.status == 422) {
                alertify.set('notifier', 'position', 'top-center');
                alertify.error(res.message);

            } else if (res.status == 200) {
                $('#userRegisterForm')[0].reset();
                var acc_modal = document.getElementById("acc-modal");
                acc_modal.style.display = "none";

                alertify.set('notifier', 'position', 'top-center');
                alertify.success(res.message);

            } else if (res.status == 500) {
                alert(res.message);
            } else if (res.status == 510) {
                alertify.set('notifier', 'position', 'top-center');
                alertify.error(res.message);
            }
        }
    });
});