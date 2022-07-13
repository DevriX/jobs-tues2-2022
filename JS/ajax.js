$(document).ready(function(){
    $('.approve').on("click",function(e) {
        e.preventDefault()
        $e = $(e.target)
        let id = $e.data("job-id")
        let status = $e.data("status")
        console.log(id);
        $.ajax({
            url: "approve_reject.php",
            type: "POST",
            data: {
                id: id,
                status: status
            },
            success: function(response) {
                if(response) {
                    if(status == 1) {
                        $e.text("Reject")
                        $e.data('status', 0)
                    } else {
                        $e.text("Approve")
                        $e.data('status', 1)
                    }
                }
            }
        })
    })
})


