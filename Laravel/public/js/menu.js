$(document).ready(function(){
    var csrf = $('#csrf').val();

    $(".update-cart").change(function (e) {
        e.preventDefault();
        var ele = $(this);
        var updateUrl = $('#updateUrl').val();
        $quantity = ele.parents("tr").find(".quantity").val();
        if(ele.parents("tr").find(".quantity").val() < 1){
            $quantity = 1;
        }
        $.ajax({
            url: updateUrl,
            method: "patch",
            data: {
                _token: csrf, 
                id: ele.parents("td").attr("data-id"), 
                quantity: $quantity
            },
            success: function (response) {
            window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        var url = $('#deleteUrl').val();
        var ele = $(this);
        
        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url:url,
                method: "DELETE",
                data: {
                    _token: csrf, 
                    id: ele.parents("th").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
});