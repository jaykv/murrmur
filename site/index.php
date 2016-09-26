<?php
    require_once('inc/inc.php');
    $lastmsg_id = isset($_GET['lastmsg_id']) ? $_GET['lastmsg_id'] : '';
    $lastmsg_id = array_key_exists('lastmsg_id', $_GET) ? $_GET['lastmsg_id'] : '';

    $action = isset($_GET['action']) ? $_GET['action'] : '';
    $action = array_key_exists('action', $_GET) ? $_GET['action'] : '';

    if($action <> "get") {
        require_once('templates/header.php');
?>

    <div class="row content body well">
        <div class="regular-navbar">
            <?php include('templates/nav.php'); ?>
        </div>

        <div class="col-sm-9 main">
            <?php
            if (isLoggedIn())
                show_post_box();
            ?>
            <div class="post_content">
                <?php
                include ( 'process/load_first.php' ); //inclusion of load_first.php
                ?>
            </div>
            <!-- <div id="auto-refresh"></div> -->
            <div id = "last_msg_loader" style="right: 0px; bottom: 0px; position: fixed;"> </div>
        </div>
    </div>

<script>
$(window).scroll(function () {
if ($(document).height() <= $(window).scrollTop() + $(window).height()) {

    lastmsg_function();
    return false;
}
});

function lastmsg_function()
{
    var id = $(".message_box:last").attr("id");

    $('div#last_msg_loader').html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>');

    $.post("index.php?action=get&last_msg_id=" + id,
    function(data){
        if (data != "") {
            $(".message_box:last").after(data);
        }
        $('div#last_msg_loader').empty();
    });
};
        /*
function startInterval(seconds, callback) {
  callback();
  return setInterval(callback, seconds * 1000);
}

function reloadChat () {
     $('#auto-refresh').load('process/posts_update.php');
}

startInterval(1, reloadChat);
    */
// actuall process post
 $(function() {
    $("button#submit-post").click(function(){
        $.ajax({
            type: "POST",
            url: "process/process_post.php",
            data: $('form.user-post').serialize(),
            success: function(msg){
                $(".post_content").prepend(msg).css('opacity', 0)
                .slideDown('slow')
                .animate( { opacity: 1 }, { queue: false, duration: 'slow' } );

            },
             error: function(){}
        });
    });
 });

 // success/failure message on post
 $(function() {
     $("button#submit-post").click(function(){
         $.ajax({
            type: "POST",
            url: "process/process_post_message.php",
            data: $('form.user-post').serialize(),
                 success: function(msg){
                         document.getElementById("user_post").value = "";
                         $("#post-message").html(msg);
                         $("#alert_message").delay(500).fadeTo(200,0).slideUp(200);
                 },
            error: function(){}
         });
     });
});

function callWithGet(file, id) {
    var data = {pid:id};
    $.ajax({
        url : file,
        type: "POST",
        data : data,
        success: function(data)
        {
            //data - response from server
            //alert(data);
        },
        error: function ()
        {

        }
    });

}

function doAction(action,pid,id)
{
    var file = "buttons/" + action + ".php";
    var data = callWithGet(file, id);

    switch (action) {
        case "delete":
            $('#deleteModal' + pid).modal('hide');
            $('#' + pid).fadeOut(300, function(){ $(this).remove();});
            break;
        case "like":
            //$('button#' + pid).a
            break;
        case "dislike":
            break;
        case "report":
            break;
    }
}
</script>
<?php
    require_once('templates/footer.php');

    } else {
        include ( 'process/load_second.php' ); //inclusion of load_second.php
    }
?>
